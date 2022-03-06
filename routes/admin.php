<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CustomersAddressesController;
use App\Http\Controllers\Backend\PaymentMethodContrller;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductCouponController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\ReviewsController;
use App\Http\Controllers\Backend\ShippingCompanyController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TagsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/logout', [LoginController::class, 'logout'])->name('logoutAdmin');
        Route::get('/dashboard', [BackendController::class, 'index'])->name('dashboard');


        ########################### Categories Route Begin ##############################

        Route::group(['prefix' => 'categories', 'as' => 'admin.'], function () {
            Route::post('/media/delete', [ProductCategoriesController::class, 'removeImage'])->name('categories.removeImage');

            Route::get('/index', [ProductCategoriesController::class, 'index'])->name('categories');
            Route::get('/create', [ProductCategoriesController::class, 'create'])->name('categories.create');
            Route::post('/store', [ProductCategoriesController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [ProductCategoriesController::class, 'edit'])->name('categories.edit');
            Route::patch('/update', [ProductCategoriesController::class, 'update'])->name('categories.update');
            Route::delete('/delete', [ProductCategoriesController::class, 'destroy'])->name('categories.delete');


        });

        ########################### Categories Route  End ##############################

        ########################### Tags Route Begin ##############################

        Route::group(['prefix' => 'tags', 'as' => 'admin.'], function () {

            Route::get('/index', [TagsController::class, 'index'])->name('tags');
            Route::get('/create', [TagsController::class, 'create'])->name('tags.create');
            Route::post('/store', [TagsController::class, 'store'])->name('tags.store');
            Route::get('/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit');
            Route::patch('/update', [TagsController::class, 'update'])->name('tags.update');
            Route::delete('/delete', [TagsController::class, 'destroy'])->name('tags.delete');


        });

        ########################### Tags Route End ##############################


        ########################### Products Route Begin ##############################

        Route::group(['prefix' => 'products', 'as' => 'admin.'], function () {

            Route::post('/media/delete', [ProductsController::class, 'removeImage'])->name('products.removeImage');


            Route::get('/index', [ProductsController::class, 'index'])->name('products');
            Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
            Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
            Route::patch('/update', [ProductsController::class, 'update'])->name('products.update');
            Route::delete('/delete', [ProductsController::class, 'destroy'])->name('products.delete');


        });


        ########################### ProductsCoupon Route Begin ##############################

        Route::group(['prefix' => 'product_coupons', 'as' => 'admin.'], function () {



            Route::get('/index', [ProductCouponController::class, 'index'])->name('coupons');
            Route::get('/create', [ProductCouponController::class, 'create'])->name('coupons.create');
            Route::post('/store', [ProductCouponController::class, 'store'])->name('coupons.store');
            Route::get('/edit/{id}', [ProductCouponController::class, 'edit'])->name('coupons.edit');
            Route::patch('/update', [ProductCouponController::class, 'update'])->name('coupons.update');
            Route::delete('/delete', [ProductCouponController::class, 'destroy'])->name('coupons.delete');


        });

        ########################### ProductsCoupon Route End ##############################


        ############################ ProductReviews Route Begin ##############################

        Route::group(['prefix' => 'reviews', 'as' => 'admin.'], function () {



            Route::get('/index', [ReviewsController::class, 'index'])->name('reviews');
            Route::get('/show/{id}', [ReviewsController::class, 'show'])->name('reviews.show');

//            Route::get('/create', [ReviewsController::class, 'create'])->name('reviews.create');
//            Route::post('/store', [ReviewsController::class, 'store'])->name('reviews.store');
            Route::get('/edit/{id}', [ReviewsController::class, 'edit'])->name('reviews.edit');
            Route::patch('/update', [ReviewsController::class, 'update'])->name('reviews.update');
            Route::delete('/delete', [ReviewsController::class, 'destroy'])->name('reviews.delete');


        });

        ########################### ProductReviews Route End ##############################


       ############################ ProductReviews Route Begin ##############################

        Route::group(['prefix' => 'customers', 'as' => 'admin.'], function () {

            Route::post('/media/delete', [CustomerController::class, 'removeImage'])->name('customers.removeImage');


            Route::get('/index', [CustomerController::class, 'index'])->name('customers');
            Route::get('/show/{id}', [CustomerController::class, 'show'])->name('customers.show');
            Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
            Route::patch('/update', [CustomerController::class, 'update'])->name('customers.update');
            Route::delete('/delete', [CustomerController::class, 'destroy'])->name('customers.delete');


        });

        ########################### ProductReviews Route End ##############################


       ############################ Country Route Begin ##############################

        Route::group(['prefix' => 'countries', 'as' => 'admin.'], function () {

            Route::get('/index', [CountryController::class, 'index'])->name('countries');
            Route::get('/show/{id}', [CountryController::class, 'show'])->name('countries.show');
            Route::get('/create', [CountryController::class, 'create'])->name('countries.create');
            Route::post('/store', [CountryController::class, 'store'])->name('countries.store');
            Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
            Route::patch('/update', [CountryController::class, 'update'])->name('countries.update');
            Route::delete('/delete', [CountryController::class, 'destroy'])->name('countries.delete');


        });

        ########################### Country Route End ##############################

       ############################ State Route Begin ##############################

        Route::group(['prefix' => 'states', 'as' => 'admin.'], function () {

            Route::get('/index', [StateController::class, 'index'])->name('states');
            Route::get('/show/{id}', [StateController::class, 'show'])->name('states.show');
            Route::get('/create', [StateController::class, 'create'])->name('states.create');
            Route::post('/store', [StateController::class, 'store'])->name('states.store');
            Route::get('/edit/{id}', [StateController::class, 'edit'])->name('states.edit');
            Route::patch('/update', [StateController::class, 'update'])->name('states.update');
            Route::delete('/delete', [StateController::class, 'destroy'])->name('states.delete');


        });

        ########################### State Route End ##############################

       ############################ City Route Begin ##############################

        Route::group(['prefix' => 'cities', 'as' => 'admin.'], function () {

            Route::get('/index', [CityController::class, 'index'])->name('cities');
            Route::get('/show/{id}', [CityController::class, 'show'])->name('cities.show');
            Route::get('/create', [CityController::class, 'create'])->name('cities.create');
            Route::post('/store', [CityController::class, 'store'])->name('cities.store');
            Route::get('/edit/{id}', [CityController::class, 'edit'])->name('cities.edit');
            Route::patch('/update', [CityController::class, 'update'])->name('cities.update');
            Route::delete('/delete', [CityController::class, 'destroy'])->name('cities.delete');


        });

        ########################### City Route End ##############################

       ############################ Customers Addresses Route Begin ##############################

        Route::group(['prefix' => 'customers_addresses', 'as' => 'admin.'], function () {

            Route::get('/get_customers', [CustomersAddressesController::class, 'get_customers'])->name('customers.get_customers');
            Route::get('/get_states/{id}', [CustomersAddressesController::class, 'get_states'])->name('states.get_states');
            Route::get('/get_cities/{id}', [CustomersAddressesController::class, 'get_cities'])->name('cities.get_cities');


            Route::get('/index', [CustomersAddressesController::class, 'index'])->name('customers_addresses');
            Route::get('/show/{id}', [CustomersAddressesController::class, 'show'])->name('customers_addresses.show');
            Route::get('/create', [CustomersAddressesController::class, 'create'])->name('customers_addresses.create');
            Route::post('/store', [CustomersAddressesController::class, 'store'])->name('customers_addresses.store');
            Route::get('/edit/{id}', [CustomersAddressesController::class, 'edit'])->name('customers_addresses.edit');
            Route::patch('/update', [CustomersAddressesController::class, 'update'])->name('customers_addresses.update');
            Route::delete('/delete', [CustomersAddressesController::class, 'destroy'])->name('customers_addresses.delete');


        });

        ########################### Customers Addresses Route End ##############################


       ############################ Shipping Company Route Begin ##############################

        Route::group(['prefix' => 'shipping_companies', 'as' => 'admin.'], function () {

            Route::get('/index', [ShippingCompanyController::class, 'index'])->name('shipping_companies');
            Route::get('/show/{id}', [ShippingCompanyController::class, 'show'])->name('shipping_companies.show');
            Route::get('/create', [ShippingCompanyController::class, 'create'])->name('shipping_companies.create');
            Route::post('/store', [ShippingCompanyController::class, 'store'])->name('shipping_companies.store');
            Route::get('/edit/{id}', [ShippingCompanyController::class, 'edit'])->name('shipping_companies.edit');
            Route::patch('/update', [ShippingCompanyController::class, 'update'])->name('shipping_companies.update');
            Route::delete('/delete', [ShippingCompanyController::class, 'destroy'])->name('shipping_companies.delete');


        });

        ########################### Shipping Company Route End ##############################


       ############################ Payment Methods Route Begin ##############################

        Route::group(['prefix' => 'payment_methods', 'as' => 'admin.'], function () {

            Route::get('/index', [PaymentMethodContrller::class, 'index'])->name('payment_methods');
            Route::get('/show/{id}', [PaymentMethodContrller::class, 'show'])->name('payment_methods.show');
            Route::get('/create', [PaymentMethodContrller::class, 'create'])->name('payment_methods.create');
            Route::post('/store', [PaymentMethodContrller::class, 'store'])->name('payment_methods.store');
            Route::get('/edit/{id}', [PaymentMethodContrller::class, 'edit'])->name('payment_methods.edit');
            Route::patch('/update', [PaymentMethodContrller::class, 'update'])->name('payment_methods.update');
            Route::delete('/delete', [PaymentMethodContrller::class, 'destroy'])->name('payment_methods.delete');


        });

        ########################### Payment Methods Route End ##############################


       ############################ Account Settings Route Begin ##############################

        Route::group(['prefix' => 'account_settings', 'as' => 'admin.'], function () {

            Route::post('/admin/removeImage', [BackendController::class, 'removeImage'])->name('admin.removeImage');


            Route::get('/index', [BackendController::class, 'account_settings'])->name('account_settings');
            Route::patch('/update', [BackendController::class, 'update_account_settings'])->name('account_settings.update');


        });

        ########################### Account Settings Route End ##############################

    });


    Route::get('/login', [LoginController::class, 'formLogin'])->name('formLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('loginAdmin');

});



