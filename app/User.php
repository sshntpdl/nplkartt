<?php

namespace App;

use App\Role;
use App\Profile;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Redis;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    protected $appends = ['lastSeen'];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','role_id','last_login_at','last_seen'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }
    public function getRouteKeyName(){
     return 'slug';
    }

    public function getCountry(){
        return $this->profile->country->name;
    }
        public function getState(){
        return $this->profile->state->name;
    }
        public function getCity(){
        return $this->profile->city->name;
    }

    public function verified()
    {
    $this->verified = 1;
    $this->email_token = null;
    $this->save();
    }
 

}
