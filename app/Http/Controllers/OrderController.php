<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use App\Cart;
use Session;
use App\Http\Requests\StoreOrder;
use App\Notifications\NeworderNotification;
use App\ServiceCenters;
use DB;
use Auth;

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
          $user=Auth::user();
          $cart = Session::get('cart');
          $centers= ServiceCenters::all();
          return view('products.checkout', compact('cart','centers','user')); 
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
        if(!isset($request->guest)){
            $user2=User::where('email',$request->email)->first();
            if(isset($user2)){
                
            }else{
                return redirect()->back()->with('message','If you want to checkout as guest.Please Select "Checkout as Guest" and continue.');
            }
        }
        //dd($request->guest);
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
                    "phone1"=>$request->phone1,
                    "phone2"=>$request->phone2,
                    "city"=>$request->city,
                ];
                DB::beginTransaction();
                $checkout = Customer::create($customer);

                foreach($cart->getContents() as $slug=> $product){
                    $products=[
                        'customer_id'=>$checkout->id,
                        'product_id'=>$product['product']->id,
                        'customer_name'=>$request->userName,
                        'product_name'=>$product['product']->title,
                        'qty'=>$product['qty'],
                        'status'=>'Pending',
                        'price'=>$product['price'],
                        'address1'=>$request->address1,
                        'address2'=>$request->address2,
                        'phone1'=>$request->phone1,
                        'phone2'=>$request->phone2,
                        'city'=>$request->city,
                        'payment_id'=>0,
                    ];
                    $order = Order::create($products);
                } 
                if($checkout && $order){
                    DB::commit();
                    //dd($checkout,$order);
                    $users=User::where('role_id','2')->get();
                    foreach($users as $user){
                        $user->notify(new NeworderNotification);
                    }
                    return redirect('/');
                    
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
    public function show()
    {
        //
    }

    public function search(Request $request){
        $value=$request->q;
        $orders = Order::where('customer_name','LIKE','%'.$value.'%')->orWhere('product_name','LIKE','%'.$value.'%')
        ->orWhere('price','LIKE','%'.$value.'%')
        ->orWhere('status','LIKE','%'.$value.'%')
        ->get();
        return view('admin.orders.index',compact('orders','value'));
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
