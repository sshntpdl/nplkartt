<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;

class Customer extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    

    public function orders(){
        return $this->hasMany('App/Order','customer_id','id');
    }
}
