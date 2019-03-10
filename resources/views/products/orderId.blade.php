@extends('layouts.app')
@section('content')
   <div class="container-fluid" style="margin-top:-4.5em;background-color:white;">
      <div class="row p-4">
         <div class="container p-4" style="border:1px solid red;border-radius:15px;">
               @if(@$ids!=null)
               <p>Your Order Id
                     @if (count($ids)>1)
                      are 
                     @else
                      is
                     @endif
                     
               @for($i=0;$i<count($ids);$i++)
               <h5><b> {{$ids[$i]}}</b>,</h5>
               @endfor
               </p>
               <p>.Please keep you order id to track you order. </p>
               <p>You Can Track Your Order Here.
                  <a href="{{route('orderTracker')}}"><button class="btn btn-success">Track My Order</button></a>
               </p>
               @endif
         </div>
      </div>
   </div>
@endsection