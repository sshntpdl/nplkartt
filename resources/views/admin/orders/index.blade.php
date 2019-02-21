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
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Orders List</h2>

  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{route('admin.order.create')}}" class="btn btn-sm btn-outline-secondary">
      Add order
    </a>
  </div>
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
        <th>Payment ID</th>
        <th>Date Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($orders) && $orders->count() > 0)
      @foreach($orders as $order)
      
      <tr>
        <td>{{$order->id}}</td>
        <td>{{@$order->customer_name}}</td>
        <td>{{@$order->product_name}}</td>
        <td>{{@$order->qty}}</td>
        <td>{{$order->status}}</td>
        <td>{{@$order->price}}</td>
        <td>{{@$order->payment_id}}</td>
        
        <td>{{$order->created_at}}</td>
        <td><a class="btn btn-info btn-sm" href="{{route('admin.order.edit',$order)}}">Edit</a> |
           <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$order->id}}')">Delete</a>
        <form id="delete-user-{{$order->id}}" action="{{ route('admin.order.destroy',$order) }}" method="POST" style="display: none;">

          @method('DELETE')
          @csrf  
              </form>
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
  <div class="col-md-12">
    {{$orders->links()}}
  </div>
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