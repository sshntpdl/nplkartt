<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Category;
use App\ServiceCenters;

class AdminController extends Controller
{
    public function __construct(){
    	
    }
    public function dashboard(){
        $customer=Customer::all();
        $product=Product::all();
        $category=Category::all();
        $services=ServiceCenters::all();
    	return view('admin.dashboard',compact('customer','product','category','services'));
    }
}
