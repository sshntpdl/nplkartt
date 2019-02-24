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

Route::resource('checkout','OrderController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/profile','UserProfileController')->middleware('auth');

Route::group(['as'=>'products.','prefix'=>'products'],function(){
    Route::get('/','ProductController@show')->name('all');
    Route::get('/{product}','ProductController@single')->name('single');
    Route::get('/addToCart/{product}','ProductController@addToCart')->name('addToCart');
});

Route::group(['as'=>'cart.', 'prefix'=>'cart'], function(){
	Route::get('/', 'ProductController@cart')->name('all');
	Route::post('/remove/{product}', 'ProductController@removeProduct')->name('remove');
	Route::post('/update/{product}', 'ProductController@updateProduct')->name('update');
});

Route::group(['as'=>'admin.','middleware'=>['auth','admin'],'prefix'=>'admin'], function(){
   

    
    Route::view('product/extras', 'admin.partials.extras')->name('product.extras');

	
    Route::view('profile/roles','admin.partials.extras')->name('profile.extras');

    Route::get('profile/states/{id?}','ProfileController@getStates')->name('profile.states');
    Route::get('profile/cities/{id?}','ProfileController@getCities')->name('profile.cities');
    Route::post('product/search','ProductController@search')->name('product.search');
    Route::post('category/search','CategoryController@search')->name('category.search');
    Route::post('profile/search','ProfileController@search')->name('profile.search');
    Route::post('order/search','OrderController@search')->name('order.search');

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('product','ProductController');
    Route::resource('category','CategoryController');
    Route::resource('profile','ProfileController');
    Route::resource('order','adminOrderController');
    Route::resource('service','ServiceCentersController');
});