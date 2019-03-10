@extends('layouts.app')
@section('content')
   <div class="container-fluid" style="margin-top:-4.5em;background-color:white;">
      <div class="row p-4">
         <div class="container p-4" style="border:1px solid red;border-radius:15px;">
            <p>Your Order for <b>{{@$orderId}}</b> is <b>{{@$stat}}</b></p>
         </div>
      </div>
   </div>
@endsection