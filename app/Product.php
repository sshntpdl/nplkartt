<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Order;
use App\Customer;

class Product extends Model
{
	use SoftDeletes;
    protected $guarded=[];
    
    
    public function categories(){
        return $this->belongsToMany("App\Category");
    }
    public function getRouteKeyName(){
   	 return 'slug';
    }
    public function orders(){
        return $this->hasOne('App\Order');
    }
}
