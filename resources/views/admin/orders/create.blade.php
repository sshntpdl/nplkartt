@extends('admin.app')
@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">Orders</li>
@endsection
@section('content')

<form action="@if(isset($order)) {{route('admin.order.update', $order)}} @else {{route('admin.order.store')}} @endif" method="post" accept-charset="utf-8">
        @csrf
        @if(isset($order))
            @method('PUT')
        @endif
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="firstName">First name</label>
    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="" value="{{@$customer->firstName}}" required="">
      @if($errors->has('firstName'))
        <div class="alert alert-danger">
          {{$errors->first('firstName')}}
        </div>
      @endif
    </div>
    <div class="col-md-6 mb-3">
      <label for="lastName">Last name</label>
      <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="{{@$customer->lastName}}" required="">
      @if($errors->has('lastName'))
        <div class="alert alert-danger">
          {{$errors->first('lastName')}}
        </div>
      @endif
    </div>
  </div>

  <div class="mb-3">
    <label for="username">Username</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">@</span>
      </div>
      <input type="text" name="userName" class="form-control" id="username" placeholder="" value="{{@$order->customer_name}}" required="">
      @if($errors->has('userName'))
        <div class="alert alert-danger">
          {{$errors->first('userName')}}
        </div>
      @endif
    </div>
  </div>

  <div class="mb-3">
    <label for="email">Email <span class="text-muted">(Optional)</span></label>
    <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="{{@$customer->email}}">
    @if($errors->has('email'))
        <div class="alert alert-danger">
          {{$errors->first('email')}}
        </div>
    @endif
  </div>

  <div class="mb-3">
    <label for="address">Address</label>
    <input type="text" name="address1" class="form-control" id="address" placeholder="1234 Main St"  value="{{@$customer->address1}}" required="">
    @if($errors->has('address1'))
        <div class="alert alert-danger">
          {{$errors->first('address1')}}
        </div>
    @endif
  </div>

  <div class="mb-3">
    <label for="address2">Address Line 2 <span class="text-muted">(Optional)</span></label>
    <input type="text" name="address2" class="form-control" id="address2" placeholder="Apartment or suite"  value="{{@$customer->address2}}">
  </div>

  <div class="mb-3">
    <label for="address2">Status</label>
    <select class="form-control" id="status" name="status">
            <option value="0" @if(isset($order) && $order->status == 'Pending') {{'selected'}} @endif >Pending</option>
            <option value="1" @if(isset($order) && $order->status == 'Publish') {{'selected'}} @endif>Publish</option>
    </select>
</div>

  <div class="row">
    <div class="col-md-5 mb-3">
      <label for="country">Country</label>
      <select name="country" class="custom-select d-block w-100" id="country" required="">
        <option value="">Choose...</option>
        <option>United States</option>
      </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="state">State</label>
      <select name="state" class="custom-select d-block w-100" id="state" required="">
        <option value="">Choose...</option>
        <option>California</option>
      </select>
    </div>
    <div class="col-md-3 mb-3">
      <label for="zip">Zip</label>
      <input type="text" name="zip" class="form-control" id="zip" placeholder="" required="">
      <div class="invalid-feedback">
        Zip code required.
      </div>
    </div>
  </div>
  
 
  <hr class="mb-4">

  <div class="col-sm-12">
        @if(isset($order))
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Update Order" />
        @else
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add Order" />
        @endif
    </div>

</form>
    
@endsection