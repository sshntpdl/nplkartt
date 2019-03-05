<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cart; 
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->with('categories')->paginate(3);
        return view('admin.products.index',compact('products'));
    }

    public function contact()
    {
        return view('layouts.partials.contacts');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('childrens')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
       $path = 'images/no-thumbnail.jpg';
       if($request->has('thumbnail')){
       $extension = ".".$request->thumbnail->getClientOriginalExtension();
       $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
       $name = $name.$extension;
       $path = $request->thumbnail->storeAs('images', $name, 'public');
       }
       if($request->has('extraphoto1')){
       $extension = ".".$request->extraphoto1->getClientOriginalExtension();
       $name = basename($request->extraphoto1->getClientOriginalName(), $extension).time();
       $name = $name.$extension;
       $path1 = $request->extraphoto1->storeAs('images', $name, 'public');
       }else{
           $path1=null;
       }
       if($request->has('extraphoto2')){
        $extension = ".".$request->extraphoto2->getClientOriginalExtension();
        $name = basename($request->extraphoto2->getClientOriginalName(), $extension).time();
        $name = $name.$extension;
        $path2 = $request->extraphoto2->storeAs('images', $name, 'public');
        }else{
            $path2=null;
        }
       if($request->has('extraphoto3')){
            $extension = ".".$request->extraphoto3->getClientOriginalExtension();
            $name = basename($request->extraphoto3->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path3 = $request->extraphoto3->storeAs('images', $name, 'public');
            }else{
                $path3=null;
            }
       if($request->has('extraphoto4')){
                $extension = ".".$request->extraphoto4->getClientOriginalExtension();
                $name = basename($request->extraphoto4->getClientOriginalName(), $extension).time();
                $name = $name.$extension;
                $path4 = $request->extraphoto4->storeAs('images', $name, 'public');
                }else{
                    $path4=null;
                }
       $product = Product::create([
            'title'=>$request->title,
           'slug' => $request->slug,
           'description'=>$request->description,
           'thumbnail' => $path,
           'status' => $request->status,
           'size_options' => isset($request->size_options) ? ($request->size_options)  : null,
           'size_values' => isset($request->size_values) ? ($request->size_values)  : null,
           'size_prices' => isset($request->size_prices) ? ($request->size_prices)  : null,
           'color_options' => isset($request->color_options) ? ($request->color_options)  : null,
           'color_values' => isset($request->color_values) ? ($request->color_values)  : null,
           'color_prices' => isset($request->color_prices) ? ($request->color_prices)  : null,
           'extraphoto1'=> $path1,
           'extraphoto2'=> $path2,
           'extraphoto3'=> $path3,
           'extraphoto4'=> $path4,
           'featured' => ($request->featured) ? $request->featured : 0,
           'price' => $request->price,
           //'discount'=>$request->discount ? $request->discount : 0,
           'discount_price' => isset($request->discount_price) ? $request->discount_price : 0,
       ]);
       if($product){
            $product->categories()->attach($request->category_id,['created_at'=>now(), 'updated_at'=>now()]);
            return back()->with('message', 'Product Successfully Added');
       }else{
            return back()->with('message', 'Error Inserting Product');
       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
 
        $categories=Category::with('childrens')->get();
        $products=Product::with('categories')->paginate(9);
        return view('products.all',compact('categories','products'));
    }

    public function search(Request $request){
        $value=$request->q;
        $products = Product::where('title','LIKE','%'.$value.'%')->orWhere('description','LIKE','%'.$value.'%')
        ->orWhere('slug','LIKE','%'.$value.'%')
        ->orWhere('price','LIKE','%'.$value.'%')->paginate(10);
        return view('admin.products.index',compact('products','value'));
    }

    public function shopSort(Request $request){
        $sortValue=$request->get('sortby');
        //dd($sortValue);
        $categories=Category::with('childrens')->get();
        if($sortValue=='recentby'){
            $products=Product::orderBy('created_at','desc')->paginate(10);
            return view('products.all',compact('categories','products','sortValue'));
        }elseif($sortValue=='popularity'){
            $products=Product::orderBy('created_at','desc')->paginate(10);
            return view('products.all',compact('categories','products','sortValue'));
        }elseif($sortValue=='offers'){
            $products=Product::orderBy('discount_price','desc')->paginate(10);
            return view('products.all',compact('categories','products','sortValue'));
        }
    }

    public function single(Product $product){
        $products=Product::inRandomOrder()->take(3)->get();
        return view('products.single',compact('product','products'));
    }

    public function addToCart(Product $product , Request $request){
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $qty = $request->qty ? $request->qty : 1;
        $cart =new Cart($oldCart);
        $cart->addProduct($product,$qty); 
        Session::put('cart',$cart);
        return back()->with('message',"Product $product->title has been successfully added to cart.");
    }

    public function cart(){
        if(!Session::has('cart')){
          return view('products.cart');
        }
        $cart = Session::get('cart');
        return view('products.cart', compact('cart'));
      }
     public function removeProduct(Product $product){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeProduct($product);
        Session::put('cart', $cart);
        return back()->with('message', "Product $product->title has been successfully removed From the Cart");
     }
      public function updateProduct(Product $product, Request $request){
    
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateProduct($product, $request->qty );
        Session::put('cart', $cart);
        return back()->with('message', "Product $product->title has been successfully Updated in the Cart");
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::with('childrens')->get();
        return view('admin.products.create',compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {
        if($request->has('thumbnail')){
            Storage::delete($product->thumbnail);
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images', $name,'public');
            $product->thumbnail = $path;
          }
          if($request->has('extraphoto1')){
            Storage::delete($product->extraphoto1);
            $extension = ".".$request->extraphoto1->getClientOriginalExtension();
            $name = basename($request->extraphoto1->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path1 = $request->extraphoto1->storeAs('images', $name, 'public');
            $product->extraphoto1 = $path1;
            }
            if($request->has('extraphoto2')){
             Storage::delete($product->extraphoto2);
             $extension = ".".$request->extraphoto2->getClientOriginalExtension();
             $name = basename($request->extraphoto2->getClientOriginalName(), $extension).time();
             $name = $name.$extension;
             $path2 = $request->extraphoto2->storeAs('images', $name, 'public');
             $product->extraphoto2 = $path2;
             }
            if($request->has('extraphoto3')){
                 Storage::delete($product->extraphoto3);
                 $extension = ".".$request->extraphoto3->getClientOriginalExtension();
                 $name = basename($request->extraphoto3->getClientOriginalName(), $extension).time();
                 $name = $name.$extension;
                 $path3 = $request->extraphoto3->storeAs('images', $name, 'public');
                 $product->extraphoto3 = $path3;
                 }
            if($request->has('extraphoto4')){
                     Storage::delete($product->extraphoto4);
                     $extension = ".".$request->extraphoto4->getClientOriginalExtension();
                     $name = basename($request->extraphoto4->getClientOriginalName(), $extension).time();
                     $name = $name.$extension;
                     $path4 = $request->extraphoto4->storeAs('images', $name, 'public');
                     $product->extraphoto4 = $path4;
                     }

         $product->title =$request->title;
         //$product->slug = $request->slug;
         $product->description = $request->description;
         $product->status = $request->status;
         $product->featured = ($request->featured) ? $request->featured : 0;
         $product->price = $request->price;
         //$product->discount = $request->discount ? $request->discount : 0;
         $product->discount_price = ($request->discount_price) ? ($request->discount_price) : 0;
         $product->size_options =  ($request->size_options) ? ($request->size_options) : null;
         $product->size_values =  ($request->size_values) ? ($request->size_values) : null;
         $product->size_prices =  ($request->size_prices) ? ($request->size_prices) : null;
         $product->color_options =  ($request->color_options) ? ($request->color_options) : null;
         $product->color_values =  ($request->color_values) ? ($request->color_values) : null;
         $product->color_prices =  ($request->color_prices) ? ($request->color_prices) : null;
         $product->categories()->detach();
         
         if($product->save()){
             $product->categories()->attach($request->category_id);
             return back()->with('message', "Product Successfully Updated!");
         }else{
             return back()->with('message', "Error Updating Product");
         }
     }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->categories()->detach() && $product->forceDelete()){
            Storage::delete($product->thumbnail);
            return back()->with('message','Product Successfully Deleted!');
        }else{
            return back()->with('message','Error Deleting Product');
        }
    }
      
}
