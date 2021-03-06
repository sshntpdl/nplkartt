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
    $featuredproducts=App\Product::where('featured','1')->take(12)->get();
    $recentproducts=App\Product::orderBy('created_at','desc')->take(8)->get();
    $offerproducts=App\Product::orderBy('discount_price','desc')->take(8)->get();
    $countProducts=DB::table('orders')
                    ->select('product_name',DB::raw('COUNT(product_name) AS occur'))
                    ->groupBy('product_name')
                    ->orderBy('occur','DESC')
                    ->get();
    foreach($countProducts as $nameProduct){
        $a[]=$nameProduct->product_name;
    }
    $popularProducts=App\Product::whereIn('title',$a)->take(8)->get();
    $categories=App\Category::all();
    $offer=App\Offer::take(4)->get();
    $brandNames=App\Product::distinct('brandName')->pluck('brandName')->take(6);
    return view('welcome',compact('featuredproducts','categories','recentproducts','offerproducts','popularProducts','brandNames','offer'));
});

Route::get('markAsRead',function(){
    auth()->user()->unReadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');

Route::resource('checkout','OrderController');
Route::get('register/verify/{token}', 'Auth\RegisterController@verify');
Route::get('orderTracker','OrderController@orderTracker')->name('orderTracker');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/profile','UserProfileController')->middleware('auth');
Route::get('/contactUs','ProductController@contact');
Route::get('products/sort','ProductController@shopSort')->name('products.sort');
Route::get('products/range','ProductController@shopRange')->name('products.range');
Route::get('products/brand','ProductController@brand')->name('products.brand');
Route::get('products/category','ProductController@category')->name('products.category');
Route::get('products/search','ProductController@productSearch')->name('products.search');
Route::get('products/review','ProductController@review')->name('products.review');
Route::get('products/deleteReview','ProductController@deleteReview')->name('products.deleteReview');


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
   
    Route::get('chart&reports', 'ChartController@index')->name('charts');
    
    Route::view('product/extras', 'admin.partials.extras')->name('product.extras');

	
    Route::view('profile/roles','admin.partials.extras')->name('profile.extras');

    Route::get('profile/states/{id?}','ProfileController@getStates')->name('profile.states');
    Route::get('profile/cities/{id?}','ProfileController@getCities')->name('profile.cities');
    Route::post('product/search','ProductController@search')->name('product.search');
    Route::post('category/search','CategoryController@search')->name('category.search');
    Route::post('profile/search','ProfileController@search')->name('profile.search');
    Route::post('order/search','OrderController@search')->name('order.search');
    Route::get('order/sort','adminOrderController@sort')->name('order.sort');
    Route::get('order/preview','adminOrderController@preview')->name('order.preview');
    Route::get('order/billPreview','adminOrderController@billPreview')->name('order.billPreview');
    Route::get('order/generate-pdf','adminOrderController@pdfview')->name('generate-pdf');
    Route::get('order/generate-bill','adminOrderController@billview')->name('generate-bill');

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('product','ProductController');
    Route::resource('category','CategoryController');
    Route::resource('profile','ProfileController');
    Route::resource('order','adminOrderController');
    Route::resource('service','ServiceCentersController');
    Route::resource('offers','OfferController');
});