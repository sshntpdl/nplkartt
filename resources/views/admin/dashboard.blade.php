@extends('admin.app')
@section('breadcrumbs')
  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="jumbotron">
        <div class="card img-fluid col-xs-12 col-sm-12 col-md-4 col-ls-4 float-left" style="width:100%">
        <img class="card-img-top float-left" src="{{asset('images/user.png')}}" alt="Card image" style="width:50%;">
          <div class="card-img-overlay">
          <h4 class="card-title float-right"><strong>Total Customers<br><span style="float:right;">{{$customer->count()}}</span></strong></h4>
            
          </div>
        </div>

        <div class="card img-fluid col-xs-12 col-sm-12 col-md-4 col-ls-4 float-left" style="width:100%">
          <img class="card-img-top float-left" src="{{asset('images/shopping.png')}}" alt="Card image" style="width:33%;">
            <div class="card-img-overlay">
              <h4 class="card-title float-right"><strong>Total Products<br><span style="float:right;">{{$product->count()}}</span></strong></h4>
              
            </div>
          </div>

          <div class="card img-fluid col-xs-12 col-sm-12 col-md-4 col-ls-4 float-left" style="width:100%">
            <img class="card-img-top float-left" src="{{asset('images/category.png')}}" alt="Card image" style="width:44%;">
              <div class="card-img-overlay">
                <h4 class="card-title float-right"><strong>Total Categories<br><span style="float:right;">{{$category->count()}}</span></strong></h4><br>
                
              </div>
            </div>
      </div>
    </div><br>
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
    </div><br>
    <div class="row">
      <div class="jumbotron col-12">
        <div class="float-left col-12" style="border-bottom: 1px solid red;padding:10px;"><h4>Service Center Info</h4>
          
            <a href="{{route('admin.service.create')}}" class="btn btn-sm btn-outline-secondary float-right" style="margin-top:-35px;">
              Add center
            </a>
            
        </div><br>
        <div class="col-12 table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>City</th>
                <th>Location</th>
                <th>Contact Number</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($services->count() > 0)
              @foreach($services as $service)
                <tr>
                <td></td>
                <td>{{$service->city}}</td>
                <td>{{$service->location}}</td>
                <td>{{$service->contact}}</td>
                <td><a class="btn btn-info btn-sm" href="{{route('admin.service.edit',$service)}}">Edit</a> |
                  <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$service->id}}')">Delete</a>
                  <form id="delete-product-{{$service->id}}" action="{{ route('admin.service.destroy', $service) }}" method="POST" style="display: none;">
                      @method('DELETE')
                      @csrf
                  </form>
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

      </div>
      
    </div>

    <div class="row">
      <div class="jumbotron col-12">

        <div class="float-left col-12" style="border-bottom: 1px solid red;padding:10px;"><h4>Offer Images</h4>
          
          <a href="{{route('admin.offers.create')}}" class="btn btn-sm btn-outline-secondary float-right" style="margin-top:-35px;">
            Add Offers Images
          </a>
          
      </div><br>
      <div class="col-12 table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Thumbnail</th>
              <th>Discount Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($offers->count() > 0)
            @foreach($offers as $offer)
              <tr>
              <td></td>
              <td>{{$offer->title}}</td>
              <td><img src="{{asset('storage/'.$offer->thumbnail)}}" alt="{{$offer->title}}" class="img-responsive" height="50"/></td>
              <td>{!! $offer->description !!}</td>
              <td>{{$offer->discount_price}}</td>
              <td><a class="btn btn-info btn-sm" href="{{route('admin.offers.edit',$offer)}}">Edit</a> |
                <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$offer->id}}')">Delete</a>
                <form id="delete-product-{{$offer->id}}" action="{{ route('admin.offers.destroy', $offer) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
              </td>
              </tr>
            @endforeach
            @else
              <tr>
              <td colspan="7" class="alert alert-info">No Images Found..</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>


      </div>
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