<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\Http\Requests\StoreUserProfile;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\Role;
use App\State;
use App\User;

use App\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     *  @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $user=User::where('id',$profile->user_id)->first();
        $products=Product::inRandomOrder()->take(3)->get();
        return view('layouts.partials.profile',compact('user','profile','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $user=User::where('id',$profile->user_id)->first();
        return view('layouts.partials.editProfile',compact('profile','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Profile $profile)
    {
        $user=User::where('id',$profile->user_id)->first();
        if($request->has('thumbnail')){
            Storage::delete($profile->thumbnail);
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images/profile', $name,'public');
            $profile->thumbnail = $path;
          }else{
            //$profile->thumbnail = 'images/no-thumbnail.jpg';
          }
        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $profile->name = $request->name;
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        if($profile->save() && $user->save()){
            return back()->with('message','Profile Succesfully Updated');
        }else{
            return back()->with('message','Failed To Updated');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
