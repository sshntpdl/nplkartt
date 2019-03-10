@extends('admin.app')
@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">Orders</li>
@endsection
@section('content')
<div class="row d-block">
    <div class="col-sm-12">
      @if (session()->has('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
      @endif
    </div>
  </div>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
  <h2 class="h2 float-left">Orders List</h2>

  
    <a href="{{route('admin.order.create')}}" class="btn btn-sm btn-outline-secondary float-left ml-4 mt-1">
      Add order
    </a>
  <form action="{{route('admin.order.search')}}" method="POST" role="search">
      @csrf
      <div class="input-group col-3 float-right">
          <input type="text" class="form-control" name="q" id="txtSearch" placeholder="Search Product" value="{{@$value}}">
           <span class="input-group-btn">
              <button type="submit" class="btn btn-outline-secondary">
                  <span data-feather="search"></span>
              </button>
          </span>
      </div>
  </form>
  <a @if(isset($sortValue)) href="{{route('admin.order.preview',['sortValue'=>$sortValue])}}" @else href="{{route('admin.order.preview',['sortValue'=>'All'])}}" @endif><button class="btn btn-outline-success btn-sm float-right mr-4 p-2" style="margin-left:-1em;" >Preview</button></a>
  <form action="{{route('admin.order.sort')}}" name='sortForm1' id="sortForm1" method="GET" role="sort" >
      @csrf
      <div class="input-group col-3 float-right">
      <select name="sortby" id="sortby" class="form-control">
        <option value="All" @if(isset($sortValue) && $sortValue == 'All') {{'selected'}} @endif>All Order</option>
        <option value="Pending" @if(isset($sortValue) && $sortValue == 'Pending') {{'selected'}} @endif>Pending Order</option>
        <option value="Processing" @if(isset($sortValue) && $sortValue == 'Processing') {{'selected'}} @endif>Processing Order</option>
        <option value="Delivered" @if(isset($sortValue) && $sortValue == 'Delivered') {{'selected'}} @endif>Delivered Order</option>
      </select>
      </div>
    </form>
 
</div>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Qty</th>
        <th>Status</th>
        <th>Price</th>
        <th>Date Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($orders) && $orders->count() > 0)
      @foreach($orders as $order)
      
      <tr @if($order->status=='Pending') style="background-color:yellowgreen;" @elseif($order->status=='Processing') style="background-color:skyblue;" @endif>
        <td>{{$order->id}}</td>
        <td>{{@$order->customer_name}}</td>
        <td>{{@$order->product_name}}</td>
        <td>{{@$order->qty}}</td>
        <td>@if($order->status=='Delivered') <span data-feather="check" style="color:green;"></span> @elseif($order->status=='Processing') <b><span data-feather="refresh-ccw" style="color:blue;"></span></b> @endif{{$order->status}}</td>
        <td>{{@$order->price}}</td>
        
        
        <td>{{$order->created_at}}</td>
        <td><a class="btn btn-info btn-sm" href="{{route('admin.order.edit',$order)}}">Edit</a> |
          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal-{{$order->id}}">
            Preview
          </button>
           | <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$order->id}}')">Delete</a>
        <form id="delete-user-{{$order->id}}" action="{{ route('admin.order.destroy',$order) }}" method="POST" style="display: none;">

          @method('DELETE')
          @csrf  
              </form>

               <!-- The Modal -->
               <div class="modal fade" id="myModal-{{$order->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
        <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Order Information</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
        <!-- Modal body -->
                    <div class="modal-body">
                      
                      <div class="col-12">
                        <h4 class="mr-5 ml-2"><strong>Information</strong></h4>
                        {{-- table started --}}
                        <div class="row pl-5">
                          <table class="table table-borderless">
    
                              <tbody>
                                  <tr>
                                      <td class="pr-2"><strong>Customer Name:</strong></td>
                                      <td class="pl-2">{{@$order->customer_name}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Product Name:</strong></td>
                                      <td class="pl-2">{{@$order->product_name}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Product Qty:</strong></td>
                                      <td class="pl-2">{{@$order->qty}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Status:</strong></td>
                                      <td class="pl-2">{{@$order->status}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Price:</strong></td>
                                      <td class="pl-2">{{@$order->price}}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <!-- table closed -->
                      </div>
                    </div>
                    
        <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="{{route('admin.order.billPreview',['orderId'=>$order->id])}}">
                            <button class="btn btn-outline-success btn-sm float-right mr-2 p-2" style="margin-left:-1em;">Get Bill</button>
                          </a>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>
            {{-- model closed --}}

        </td>
      </tr>
      
      @endforeach
      @else
      <tr>
        <td colspan="7" class="alert alert-info">No users Found..</td>
      </tr>
      @endif

    </tbody>

  </table>
</div>
<div class="row">
  {{-- <div class="col-md-12">
    {{ $orders->render() }}
  </div> --}}
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  function confirmDelete(id){
    let choice = confirm("Are You sure, You want to Delete this user ?")
    if(choice){
      document.getElementById('delete-user-'+id).submit();
    }
  }
</script>
@endsection