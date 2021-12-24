<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductsController;
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

            Route::get('/index', [ProductsController::class, 'index'])->name('products');
            Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
            Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
            Route::patch('/update', [ProductsController::class, 'update'])->name('products.update');
            Route::delete('/delete', [ProductsController::class, 'destroy'])->name('products.delete');


        });

        ########################### Products Route End ##############################

    });


    Route::get('/login', [LoginController::class, 'formLogin'])->name('formLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('loginAdmin');

});



