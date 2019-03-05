@extends('admin.app')
@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
  <li class="breadcrumb-item active" aria-current="page">Charts & Reports</li>
@endsection
@section('content')
<h2 class="modal-title" style="border-bottom:1px solid red;">Charts & Reports</h2><br>
<div class="container">
    {{-- <div class="row p-2 ml-1 mb-3 shadow-sm"  style="border-radius:15px;background-color:white;">
        <div class="row ml-2" style="width:100%;" ><h4><strong>Get Report Here</strong></h4></div>
        <div class="row ml-2" style="width:100%;" >
            <h6 class="mt-2 ml-3"><strong>Get</strong></h6>
            <div class="col-4">
                <form action="#" name='sortForm2' id="sortForm2" method="GET" role="sort" >
                        @csrf
                        <div class="input-group mb-1">
                        <select name="sortby2" id="sortby2" class="form-control">
                        <option value="All" @if(isset($sortValue) && $sortValue == 'All') {{'selected'}} @endif>All Order</option>
                        <option value="Pending" @if(isset($sortValue) && $sortValue == 'Pending') {{'selected'}} @endif>Pending Order</option>
                        <option value="Processing" @if(isset($sortValue) && $sortValue == 'Processing') {{'selected'}} @endif>Processing Order</option>
                        <option value="Delivered" @if(isset($sortValue) && $sortValue == 'Delivered') {{'selected'}} @endif>Delivered Order</option>
                        </select>
                        </div>
                </form>
            </div> 
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                    <span data-feather="eye"></span> Preview
            </button>
             <button type="button" class="btn btn-sm btn-warning ml-2" data-toggle="modal" data-target="#myModal">
                   <span data-feather="printer"></span> Print
            </button>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Chart Demo</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                </div><br>
                {{-- <div class="panel-body">
                    {!! $piechart->html() !!}
                </div><br> --}}
                <div class="panel-body">
                    {!! $linechart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{{-- {!! $piechart->script() !!} --}}
{!! $linechart->script() !!}
@endsection