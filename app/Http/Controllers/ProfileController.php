<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Http\Requests\StoreUserProfile;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\Role;
use App\State;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role','profile')->paginate(5);

        return view('admin.users.index',compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $countries = Country::all();
        return view('admin.users.create',compact('roles','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserProfile $request)
    {
        dd('store');
        $path = 'images/profile/no-thumbnail.jpg';
      if($request->has('thumbnail')){
       $extension = ".".$request->thumbnail->getClientOriginalExtension();
       $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
       $name = $name.$extension;
       $path = $request->thumbnail->storeAs('images/profile', $name, 'public');
     }
       $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $request->status,
       ]);
       if($user){
        $profile = Profile::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'thumbnail' => $path,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'slug' => $request->slug,
        ]);
       }
       if($user && $profile)
            return redirect(route('admin.profile.index'))->with('message','User Created Successfully');
        else
            return back()->with('message', 'Error Inserting new User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $user = User::where('id',$profile->user_id)->first();
        $countries = Country::all();
        $roles = Role::all();
        return view('admin.users.create',compact('roles','countries','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        dd('hello');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        dd($profile);
    }

     
    public function getStates(Request $request, $id){
        if($request->ajax())
            return State::where('country_id', $id)->get();
        else{
            return 0;
        }
    }
    public function getCities(Request $request, $id){
        if($request->ajax())
            return City::where('state_id', $id)->get();
        else{
            return 0;
        }
    }
}
