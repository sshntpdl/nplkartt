@extends('layouts.app')
@section('content')
<div class="col-xs-3 col-sm-3 col-md-3 col-ls-3 float-left" style="border-right:2px solid yellowgreen;height:100%;">
    <div class="row justify-content-center">
        <img class="profile-image" src="{{asset('storage/'.@$profile->thumbnail)}}" alt="" style="width:150px;height:150px;border-radius:125px;">    
    </div>    
    <div class="row justify-content-center">
            <h3>@<strong>{{@$profile->name}}</strong></h3><br>
    </div>
    <div class="row justify-content-center">
        <strong>{{@$user->role->name}}</strong><br>
    </div>
    <div class="row justify-content-center pt-2">
        <a href="{{route('profile.edit',$profile)}}" class="btn btn-sm btn-outline-secondary">
            <span data-feather="edit" style="width:15px;margin:-4px;"></span> Edit Profile
        </a>
    </div>
</div>
<div class="col-xs-9 col-sm-9 col-md-9 col-ls-9 float-left">
        <h3 class="mr-5 ml-2"> Information</h3>
    <div class="row pl-5">
        <table>
            <thead>
                <th colspan="4" ></th>
                <th colspan="8" ></th>
            </thead>
            <tbody>
                <tr>
                    <td class="pr-2"><strong>Name:</strong></td>
                    <td class="pl-2">{{@$profile->name}}</td>
                </tr>
                <tr>
                    <td class="pr-2"><strong>Status:</strong></td>
                    <td class="pl-2"> @if((@$user->status) == 1) Active User @else Blocked @endif </td>
                </tr>
                <tr>
                    <td class="pr-2"><strong>Role:</strong></td>
                    <td class="pl-2">{{@$user->role->name}}</td>
                </tr>
                <tr>
                    <td class="pr-2"><strong>Email:</strong></td>
                    <td class="pl-2">{{@$user->email}}</td>
                </tr>
                <tr>
                    <td class="pr-2"><strong>Phone:</strong></td>
                    <td class="pl-2">{{@$profile->phone}}</td>
                </tr>
                <tr>
                    <td class="pr-2"><strong>Address:</strong></td>
                    <td class="pl-2">{{@$profile->address}}</td>
                </tr>
               
            </tbody>
        </table>
    </div>
    <div class="row pl-5 pt-5">
        <div class="row" style="border-bottom:1px solid red"><h3>Products you may like...</h3></div></div>
    <div class="row pl-5 pt-5">
       @foreach($products as $product)
        <div class="col-3 justify-content-center p-3">
            <div class="row justify-content-center p-1"><img class="profile-image" src="{{asset('storage/'.@$product->thumbnail)}}" alt="" style="width:150px;height:150px;border-radius:125px;"></div>    
            <div class="row justify-content-center p-1"><strong>{{@$product->title}}</strong></div>
            <br><div class="row justify-content-center">
                    <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="{{route('products.single',$product)}}">View Products</a>
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="{{route('products.addToCart',$product)}}">Add to carts</a>
                    </div>
            </div>
        </div>  
        @endforeach
    </div>
</div>
@endsection