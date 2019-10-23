<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('theme.store.index');
});

Route::get('/shop', function () {
    return view('theme.store.shop');
});

Route::get('/blog', function () {
    return view('theme.store.blog');
});

Route::get('/about', function () {
    return view('theme.store.about');
});

Route::get('/cart', function () {
    return view('theme.store.cart');
});

Route::get('/checkout', function () {
    return view('theme.store.checkout');
});

Route::get('/product-detail', function () {
    return view('theme.store.product-detail');
});

Route::get('/add-to-wishlist', function () {
    return view('theme.store.add-to-wishlist');
});

Route::get('/order-complete', function () {
    return view('theme.store.order-complete');
});

Route::get('products', 'ProductController@index')->name('products.show');

Route::get('products/{product}', 'ProductController@show')->name('products.show');

Route::get('/admin', function() {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');


Route::middleware(['auth'])-> prefix('admin')-> name('admin.')-> namespace('Admin')->group(function () {
    // Route::get('/', function () {
    //     // Uses first & second Middleware
    // });

    // Route::get('user/profile', function () {
    //     // Uses first & second Middleware
    // });
    // Route::get('products', 'ProductController@index')->name('products.index');
    Route::resource('products', 'ProductController');


});