<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view_category', [AdminController::class, 'view_category'])->name('view_category');
Route::post('/view_category', [AdminController::class, 'add_category'])->name('add_category');
Route::get('/delete_category', [AdminController::class, 'delete_category'])->name('delete_category');
Route::get('/add_product', [AdminController::class, 'add_product'])->name('add_product');
Route::post('/add_product', [AdminController::class, 'add_new_product'])->name('add_product');
Route::get('/show_product', [AdminController::class, 'show_product'])->name('show_product');
Route::get('/delete_product', [AdminController::class, 'delete_Product']);
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::post('/update_product', [AdminController::class, 'finalise_update_product'])->name('finish_update_product');
// get all info about home controller
Route::get('/single_product/{id}', [HomeController::class, 'single_product'])->name('single_product');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/cart/{id}', [HomeController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/add_to_cart', [HomeController::class, 'add_to_cart_single'])->name('add_to_cart_single');
Route::post('/cart', [HomeController::class, 'edit_quantity'])->name('edit_quantity');
Route::get('/cart_deletion/{id}', [HomeController::class, 'delete_cart'])->name('delete_cart');
Route::post('/add_order', [HomeController::class, 'add_order'])->name('add_order');
Route::get('/your_order', [HomeController::class, 'your_order'])->name('your_order');
Route::get('/details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/paynow/{id}', [HomeController::class, 'paynow'])->name('paynow');
Route::post('stripe/{id}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/admin_show_orders', [AdminController::class, 'admin_show_orders'])->name('admin_show_orders');
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf'])->name('print_pdf');
Route::get('/send_email/{id}', [AdminController::class, 'send_email'])->name('send_email');
Route::post('/send_email/{id}', [AdminController::class, 'sendemail'])->name('sendemail');
Route::get('/update_product', function () {
    return view('admin.update_product');
})->name('update_product_route');
Route::get('/view_users', [AdminController::class, 'view_users'])->name('view_users');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('./redirect', [HomeController::class, 'redirect']);
Route::get('/admin_home', [AdminController::class, 'admin_home'])->name('admin_home');
require __DIR__ . '/auth.php';