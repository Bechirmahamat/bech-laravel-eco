<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddProductRquest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Oders;
use App\Models\Odered_item;
use App\Notifications\sendEmailNotification;
use Illuminate\Support\Facades\Notification;
// use Barryvdh\DomPDF\PDF;
use PDF;

class AdminController extends Controller
{
    public function view_category()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $data = Category::all();
        return view('admin.category', compact('data'));
    }
    public function add_category(Request $request)
    {
        $insert = Category::create([
            'category_name' => $request->category_name

        ]);
        return redirect()->back()->with('message', 'category added successfully');
    }
    public function delete_category(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $id = $request->query('id');
        $delete = Category::find($id);
        $delete->delete();

        return redirect()->back()->with('delete', 'item deleted successfully');
        # code...
    }
    public function add_product()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $category = Category::all();

        // dd($category);
        return view('admin.add_product', compact('category'));
    }

    public function add_new_product(AddProductRquest $request)
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product = Products::create($validatedData);


        return redirect()->back()->with('message', 'Product added successfully.');
    }
    public function show_product()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $products = Products::all();
        return view('admin.show_product', compact('products'));
    }
    public function delete_Product(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $id = $request->input('id');
        $deleted = Products::find($id);
        $deleted->delete();
        return redirect()->back()->with('delete', 'product deleted successfully');
    }

    public function admin_home()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        return view('admin.home');
    }
    public function view_users()
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $users = User::where('status', 'user')->paginate(5);

        return view('admin.view_users', compact('users'));
    }
    public function update_product($id)
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $product = Products::find($id);
        $category = Category::all();
        return redirect()->route('update_product_route')->withInput([
            'image' => $product->image,
            'id' => $product->id,
            'category' => $product->category,
            'title' => $product->title,
            'quantity' => $product->quantity,
            'description' => $product->description,
            'price' => $product->price,
            'discount_price' => $product->discount_price,
            'categories' => $category,
        ]);
    }
    public function finalise_update_product(UpdateProductRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->Route('login');
        }
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $request->prev_image;
        }
        $update = Products::find($request->id);
        $update->quantity = $validatedData['quantity'];
        $update->description = $validatedData['description'];
        $update->save();
        return redirect()->Route('show_product')->with('message', 'products updated successfully');
    }
    public function admin_show_orders()
    {
        $orders = Oders::all();
        return view('admin.show_orders', compact('orders'));
    }
    public function print_pdf($id)
    {
        $orders = Odered_item::where('order_id', $id)->get();
        $user = Oders::find($id);
        $pdf = PDF::loadView('admin.print_pdf', compact('orders', 'user'));
        return $pdf->download('order_details.pdf');
    }
    public function send_email($id)
    {
        $orders = Oders::find($id);
        return view('admin.send_email', compact('orders'));
    }
    public function sendemail(Request $request, $id)
    {
        $order = Oders::find($id);
        $detail = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,

        ];
        Notification::send($order, new sendEmailNotification($detail));
        return redirect()->back();
    }
}