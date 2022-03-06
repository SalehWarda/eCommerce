<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('frontend.wishlist');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
Route::post('/checkout/payment', [PaymentController::class, 'checkout_now'])->name('frontend.checkout.payment');
Route::get('/product/{slug?}', [FrontendController::class, 'product'])->name('frontend.product');
Route::get('/shop/{slug?}', [FrontendController::class, 'shop'])->name('frontend.shop');
Route::get('/shop/tags/{slug}', [FrontendController::class, 'shop_tag'])->name('frontend.shop_tag');


Route::get('/checkout/{order_id}/cancelled', [PaymentController::class, 'cancelled'])->name('checkout.cancel');
Route::get('/checkout/{order_id}/completed', [PaymentController::class, 'completed'])->name('checkout.complete');
Route::get('/checkout/webhook/{order?}/{env?}', [PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');








Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
