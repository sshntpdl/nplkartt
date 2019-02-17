<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use App\Cart;
use Session;
use App\Http\Requests\StoreOrder;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::has('cart') || empty(Session::get('cart')->getContents() )){
            return redirect('products')->with('message','No Products in the Cart');
          }
          $cart = Session::get('cart');
          return view('products.checkout', compact('cart')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        $cart = [];
        $order=[];
        $checkout=[];
        if(Session::has('cart')){
            $cart=Session::get('cart');
        }
            $customer = [
                "firstName"=>$request->firstName,
                "lastName"=>$request->lastName,
                "userName"=>$request->userName,
                "email"=>$request->email,
                "address1"=>$request->address1,
                "address2"=>$request->address2,
                "country"=>$request->country,
                "state"=>$request->state,
                "zip"=>$request->zip,
            ];
            DB::beginTransaction();
            $checkout = Customer::create($customer);
            foreach($cart->getContents() as $slug=> $product){
                $products=[
                    'user_id'=>$checkout->id,
                    'product_id'=>$product['product']->id,
                    'qty'=>$product['qty'],
                    'status'=>'Pending',
                    'price'=>$product['price'],
                    'payment_id'=>0,
                ];
                $order = Order::create($products);
            } 
            if($checkout && $order){
                DB::commit();
                return redirect('home');
            }else{
                DB::rollback();
                return redirect('checkout')->with('message','Invalid Activity'); 
            }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
