<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Customer;
use App\User;
use App\ServiceCenters;
use App\Notifications\NeworderNotification;
use App\Http\Requests\StoreOrder;
use Illuminate\Support\Facades\DB;
use PDF;

class adminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $orders=Order::orderBy('created_at','desc')->with('customers','products')->get();
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders=Order::all();
        $centers=ServiceCenters::all();
        return view('admin.orders.create',compact('orders','centers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
       
        $order=[];
        $checkout=[];
       
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
                $products=[
                    'customer_id'=>$checkout->id,
                    'product_id'=>1,
                    'customer_name'=>$request->firstName.' '.$request->lastName,
                    'product_name'=>$request->productName,
                    'qty'=>$request->productQty,
                    'status'=>$request->status,
                    'visit'=>($request->visit) ? $request->visit : 0,
                    'price'=>$request->productPrice,
                    "address1"=>$request->address1,
                    "address2"=>$request->address2,
                    "phone1"=>$request->phone1,
                    "phone2"=>$request->phone2,
                    "city"=>$request->city,
                    'payment_id'=>0,
                ];
                $order = Order::create($products);
            if($checkout && $order){
                DB::commit();
                $users=User::where('role_id','2')->get();
                foreach($users as $user){
                $user->notify(new NeworderNotification);
                }
                return redirect('admin/order');
            }else{
                DB::rollback();
                return redirect('admin')->with('message','Invalid Activity'); 
            }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function pdfview(Request $request){
        if($request->has('download')) {
            $sortValue=$request->sortValue;
            if($sortValue=='Pending'){
                $orders=Order::where('status','Pending')->with('customers','products')->get();
                
            }elseif($sortValue=='Processing'){
                $orders=Order::where('status','Processing')->with('customers','products')->get();
              
            }elseif($sortValue=='Delivered'){
                $orders=Order::where('status','Delivered')->with('customers','products')->get();
              
            }else{
                $orders=Order::orderBy('created_at','desc')->with('customers','products')->get();
            
            }
        	// pass view file
            $pdf = PDF::loadView('admin.orders.preview',['orders'=>$orders,'sortValue'=>$sortValue]);
            // download pdf
            return $pdf->download($sortValue.'orderlist.pdf');
        }
        return redirect()->back()->with('message','failed to do');

    }

    public function billview(Request $request){
        if($request->has('download')) {
            $order=Order::where('id',$request->order)->first();
        	// pass view file
            $pdf = PDF::loadView('admin.orders.billPreview',['order'=>$order]);
            // download pdf
            return $pdf->download('bill-'.$order->customer_name.'.pdf');
        }
        return redirect()->back()->with('message','failed to do');

    }

    public function sort(Request $request){
        $sortValue=$request->get('sortby');
        //dd($sortValue);
        if($sortValue=='Pending'){
            $orders=Order::where('status','Pending')->with('customers','products')->get();
            return view('admin.orders.index',compact('orders','sortValue'));
        }elseif($sortValue=='Processing'){
            $orders=Order::where('status','Processing')->with('customers','products')->get();
            return view('admin.orders.index',compact('orders','sortValue'));
        }elseif($sortValue=='Delivered'){
            $orders=Order::where('status','Delivered')->with('customers','products')->get();
            return view('admin.orders.index',compact('orders','sortValue'));
        }else{
            $orders=Order::orderBy('created_at','desc')->with('customers','products')->get();
            return view('admin.orders.index',compact('orders','sortValue'));
        }

    }

    public function preview(Request $request){
        $sortValue=$request->sortValue;
        if($sortValue=='Pending'){
            $orders=Order::where('status','Pending')->with('customers','products')->get();
            return view('admin.orders.preview',compact('orders','sortValue'));
        }elseif($sortValue=='Processing'){
            $orders=Order::where('status','Processing')->with('customers','products')->get();
            return view('admin.orders.preview',compact('orders','sortValue'));
        }elseif($sortValue=='Delivered'){
            $orders=Order::where('status','Delivered')->with('customers','products')->get();
            return view('admin.orders.preview',compact('orders','sortValue'));
        }else{
            $orders=Order::orderBy('created_at','desc')->with('customers','products')->get();
            return view('admin.orders.preview',compact('orders','sortValue'));
        }
    }

    public function billPreview(Request $request){
        $orderId=$request->orderId;
        $order=Order::where('id',$orderId)->first();
        return view('admin.orders.billPreview',compact('orderId','order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $orders=Order::where('id','=',$order->id)->get();
        $customer=Customer::where('id','=',$order->customer_id)->first();
        $product=Product::where('id','=',$order->product_id)->first();
        $centers=ServiceCenters::all();
        //dd($order,$customer,$product);
        return view('admin.orders.create',['orders'=>$orders,'order'=>$order,'customer'=>$customer,'product'=>$product,'centers'=>$centers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Order $order)
    {
        $customer=Customer::where('id',$order->customer_id)->first();
        $order->customer_name=$request->firstName.' '.$request->firstName;
        $order->product_name=$request->productName;
        $order->qty=$request->productQty;
        $order->status=$request->status;
        $order->visit=($request->visit) ? $request->visit : 0;
        $order->price=$request->productPrice;
        $order->address1=$request->address1;
        $order->address2=$request->address2;
        $order->phone1=$request->phone1;
        $order->phone2=$request->phone2;
        $order->city=$request->city;
        $customer->email=$request->email;
        $customer->firstName=$request->firstName;
        $customer->lastName=$request->lastName;
        $customer->userName=$request->userName;
        $customer->address1=$request->address1;
        $customer->address2=$request->address2;
        $customer->phone1=$request->phone1;
        $customer->phone2=$request->phone2;
        $customer->city=$request->city;
        if($order->save() && $customer->save() ){
            return redirect('admin/order')->with('message','Order successfully Updated');
        }else{
            return redirect('admin/order')->with('message','Order failed to Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->forceDelete()){
            return redirect()->back()->with('message',"Record Succesfully Deleted");
        }else{
            return redirect()->back()->with('message',"Error deleting record");
        }
    }
}
