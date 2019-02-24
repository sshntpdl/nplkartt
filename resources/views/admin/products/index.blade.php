@extends('admin.app')
@section('breadcrumbs')
 <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">Products</li>
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
	<h2 class="h2 float-left">Products List</h2>
  
  
    <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-outline-secondary float-left ml-4 mt-1">
      Add Product
    </a>

  <form action="{{route('admin.product.search')}}" method="POST" role="search">
      @csrf
      <div class="input-group col-3 float-right">
          <input type="text" class="form-control" name="q" id="txtSearch" placeholder="Search Product" value="{{@$value}}">
           <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                  <span data-feather="search"></span>
              </button>
          </span>
      </div>
  </form>
  
</div>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Description</th>
		    <th>Categories</th>
		    <th>Price</th>
        <th>Thumbnail</th>
        <th>Date Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @if($products->count() > 0)
      @foreach($products as $product)
      <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->title}}</td>
        <td>{!! substr($product->description,0,30) !!}</td>
        <td>
          @if($product->categories()->count() > 0)
          @foreach($product->categories as $children)
          {{$children->title}},
          @endforeach
          @else
          <strong>{{"product"}}</strong>
          @endif
		</td>
        <td>${{$product->price}}</td>
        <td><img src="{{asset('storage/'.$product->thumbnail)}}" alt="{{$product->title}}" class="img-responsive" height="50"/></td>
       
        <td>{{$product->created_at}}</td>
        <td><a class="btn btn-info btn-sm" href="{{route('admin.product.edit',$product->slug)}}">Edit</a> |
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal-{{$product->id}}">
              Preview
            </button>
          | <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$product->id}}')">Delete</a>
        <form id="delete-product-{{$product->id}}" action="{{ route('admin.product.destroy', $product->slug) }}" method="POST" style="display: none;">

          @method('DELETE')
          @csrf
        </form>
       

                <!-- The Modal -->
                <div class="modal fade" id="myModal-{{$product->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
          <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Product Information</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      
          <!-- Modal body -->
                      <div class="modal-body">
                        <div class="col-4 float-left"  style="border-right:2px solid yellowgreen;height:100%;">
                          <div class="row justify-content-center">
                            <img class="profile-image" src="{{asset('storage/'.@$product->thumbnail)}}" alt="" style="width:100px;height:100px;border-radius:125px;">    
                          </div>
                          <div class="row justify-content-center">
                            <h5><strong>{{@$product->title}}</strong></h5>
                          </div>
                        </div>

                        <div class="col-8 float-left">
                          <h4 class="mr-5 ml-2"><strong>Information</strong></h4>
                          {{-- table started --}}
                          <div class="row pl-5">
                            <table class="table table-borderless">
      
                                <tbody>
                                    <tr>
                                        <td class="pr-2"><strong>Name:</strong></td>
                                        <td class="pl-2">{{@$product->title}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>Description:</strong></td>
                                        <td class="pl-2">{!! $product->description !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>Categories:</strong></td>
                                        <td class="pl-2">
                                          @if($product->categories()->count() > 0)
                                          @foreach($product->categories as $children)
                                          {{$children->title}},
                                          @endforeach
                                          @else
                                          <strong>{{"product"}}</strong>
                                          @endif
                                          </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>Price:</strong></td>
                                        <td class="pl-2">{{@$product->price}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- table closed -->
                        </div>
                      </div>
                      
          <!-- Modal footer -->
                      <div class="modal-footer">
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
        <td colspan="7" class="alert alert-info">No products Found..</td>
      </tr>
      @endif

    </tbody>

  </table>
</div>
<div class="row">
  <div class="col-md-12">
    {{$products->links()}}
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  function confirmDelete(id){
    let choice = confirm("Are You sure, You want to Delete this Product ?")
    if(choice){
      document.getElementById('delete-product-'+id).submit();
    }
  }
</script>
@endsection