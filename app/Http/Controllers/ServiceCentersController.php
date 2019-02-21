<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceCenters;

class ServiceCentersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services=ServiceCenters::all();
        return view('admin.services.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'city'=>'required',
            'location'=>'required',
            'contact'=>'required',
        ]);
        $services = ServiceCenters::create($request->only('city','location','contact'));
        return back()->with('message','Service Centers Added Successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceCenters  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceCenters $service)
    {
        //dd('serviceEdit'.$service->city);
        return view('admin.services.create',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceCenters  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceCenters $service)
    {
         
        $request->validate([
            'city'=>'required',
            'location'=>'required',
            'contact'=>'required',
        ]);
        $service->city=$request->city;
        $service->location=$request->location;
        $service->contact=$request->contact;
        $service->save();
        return redirect('admin/dashboard')->with('message','Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceCenters  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceCenters $service)
    {
        if($service->forceDelete()){
            return back()->with('message','Record Successfully Deleted!');
        }else{
            return back()->with('message','Error Deleting Record');
        }
    }
}
