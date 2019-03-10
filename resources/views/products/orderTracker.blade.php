@extends('layouts.app')
@section('content')
<div class="container-fluid" style="margin-top:-4.5em;background-color:white;">
        <div class="row p-4">
           <div class="container p-4" style="border:1px solid red;border-radius:15px;">
               <div>
               <p>You can Track Your Order Here:</p>
               <form action="{{route('orderTracker')}}" method="get">
                     @csrf
                     <label class="form-control-label">OrderId:</label>
                     <input type="text" name="orderId" class="form-control" value="{{@$orderId}}" />
                     <button class="btn btn-success">Track My Order</button>
               </form>
               </div>
           </div>
        </div>
</div>
@endsection