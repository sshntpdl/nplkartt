<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;

class OfferController extends Controller
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
        return view('admin.offers.create');
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
            'title'=>'required',
            'description'=>'required',
            'thumbnail' => 'mimes:jpeg,bmp,png|max:2048',
            'discount_price'=>'required'
        ]);
        $path = 'images/no-thumbnail.jpg';
       if($request->has('thumbnail')){
       $extension = ".".$request->thumbnail->getClientOriginalExtension();
       $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
       $name = $name.$extension;
       $path = $request->thumbnail->storeAs('images', $name, 'public');
       }
        $offers = Offer::create([
        'title'=>$request->title,
        'description'=>$request->description,
        'thumbnail'=>$path,
        'discount_price'=>$request->discount_price,
        ]);
        return back()->with('message','Image Added Successfully!');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('admin.offers.create',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //dd('update');
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'thumbnail' => 'mimes:jpeg,bmp,png|max:2048',
            'discount_price'=>'required'
        ]);
        if($request->has('thumbnail')){
            Storage::delete($offer->thumbnail);
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images', $name,'public');
            $offer->thumbnail = $path;
          }
          $offer->title=$request->title;
          $offer->description=$request->description;
          $offer->discount_price=$request->discount_price;
          $offer->save();
          return redirect('admin/dashboard')->with('message','Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        if($offer->forceDelete()){
            return back()->with('message','Record Successfully Deleted!');
        }else{
            return back()->with('message','Error Deleting Record');
        }
    }
}
