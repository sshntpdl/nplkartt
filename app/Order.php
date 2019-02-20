<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Customer;
use App\Product;

class Order extends Model
{
	use SoftDeletes;
    protected $guarded=[];
    
    
    public function customers(){
        return $this->belongsTo('App\Customer');
    } 
    public function products(){
        return $this->belongsTo('App\Product');
    }
}
