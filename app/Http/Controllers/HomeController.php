<?php

namespace App\Http\Controllers;

use App\Http\Requests\orderRequest;
use id;
use App\Models\Cart;
use App\Models\Odered_item;
use App\Models\User;
use App\Models\Oders;
use App\Models\Products;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Resources\view;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Floats;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::paginate(3);
        if (auth()->user()) {
            $user_status = auth()->user()->status;
            if ($user_status == 'user') {
                return view('home.userpage', compact('products'));
            } else {
                return view('admin.home');
            }
        }
        return view('home.userpage', compact('products'));
    }
    public function redirect()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $products = Products::paginate(6);

        $user_status = auth()->user()->status;


        if ($user_status == 'user') {
            return view('home.userpage', compact('products'));
        } else {
            return view('admin.home');
        }
    }
    public function single_product($id)
    {
        $product = Products::find($id);
        return view('home.single_product', compact('product'));
    }
    public function cart()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('home.cart', compact('carts'));
        } else {
            return redirect()->Route('login');
        }
    }
    public function add_to_cart($id)
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
            exit;
        }


        $cart = Cart::where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->get();

        if (!$cart->isEmpty()) {

            return redirect()->Route('cart');
        } else {

            $product = Products::find($id);
            $add_product = new Cart();
            $add_product->product_id = $product->id;
            $add_product->product_title = $product->title;
            $add_product->product_image = $product->image;
            $add_product->product_quantity = 1;
            $add_product->product_price = (float) $product->price - (float) $product->discount_price;
            $add_product->user_id = Auth::user()->id;
            $add_product->save();
        }

        return redirect()->Route('cart');
    }
    public function add_to_cart_single(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->Route('login');
        }

        $cart = Cart::where('product_id', $request->id)
            ->where('user_id', Auth::user()->id)
            ->get();

        if (!$cart->isEmpty()) {

            return redirect()->Route('cart');
        } else {

            $product = Products::find($request->id);
            $add_product = new Cart();
            $add_product->product_id = $product->id;
            $add_product->product_title = $product->title;
            $add_product->product_image = $product->image;
            $add_product->product_quantity = $request->quantity;
            $add_product->product_price = (float) $product->price - (float) $product->discount_price;
            $add_product->user_id = Auth::user()->id;
            $add_product->save();
        }

        return redirect()->Route('cart');
    }

    public function edit_quantity(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->product_quantity = $request->quantity;
        $cart->save();
        return redirect()->Route('cart');
    }
    public function delete_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->Route('cart');
    }
    // home.paynow
    public function checkout()
    {

        $user = User::find(Auth::user()->id);
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('home.checkout', compact('user', 'carts'));
    }
    public function add_order(orderRequest $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $total = 0;
        if ($carts->isEmpty()) {
            return redirect()->Route('your_order');
        }
        foreach ($carts as $cart) {
            $total += $cart->product_price * $cart->product_quantity;
        }
        $Validated = $request->validated();
        session(['total' => $total]);
        // insert into order table
        $order = new Oders();
        $order->user_id = Auth::user()->id;
        $order->price = $total;
        $order->phone = $Validated['phone'];
        $order->address = $Validated['address'];
        $order->city = $Validated['city'];
        $order->name = $Validated['name'];
        $order->email = $Validated['email'];
        $order->order_status = 'not paid';
        $order->save();
        $Order_id = $order->id;

        foreach ($carts as $cart) {

            $order_item = new Odered_item();
            $order_item->user_id = Auth::user()->id;
            $order_item->order_id = $Order_id;
            $order_item->title = $cart->product_title;
            $order_item->quantity = $cart->product_quantity;
            $order_item->order_status = $cart->product_id;
            $order_item->price = $cart->product_price;
            $order_item->image = $cart->product_image;

            $order_item->save();
            $cart->delete();
        }
        $id = $Order_id;
        return view('home.stripe', compact('total', 'id'));
    }
    public function your_order()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        } else {
            $orders = Oders::where('user_id', Auth::user()->id)->get();

            return view('home.your_order', compact('orders'));
        }
    }
    public function details($id)
    {
        $order = Oders::find($id);
        $order_status = false;
        if ($order->order_status == 'not paid') {
            session(['total' => $order->price]);

            $order_status = true;
        } else {
            session(['total' => 0]);
            $order_status = false;
        }

        $order_id = $id;
        $orders = Odered_item::where('order_id', $id)->get();
        return view('home.details', compact('orders', 'order_status', 'order_id'));
    }
    public function paynow($id)
    {

        $order = Oders::find($id);
        session(['total' => $order->price]);
        $total = $order->price;
        return view('home.stripe', compact('total', 'id'));
    }
    public function stripePost(Request $request, $id)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => (float) session('total') * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment."
        ]);
        // dd($id);
        $order = Oders::where('id', $id)->update(['order_status' => 'paid']);

        session()->flash('success', 'Payment successful!');

        return back();
    }
}
