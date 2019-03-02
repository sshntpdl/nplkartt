@extends('layouts.app')
@section('content')
        <div class="container">
          <div class="row shadow-sm " style="background-color:white;border-radius:15px;">
                  <div class="row p-5 mt-1">
                      <div class="col-md-5">
                            <img class="img-thumbnail p-2" src="{{asset('storage/'.$product->thumbnail)}}">
                            <div class="row">
                              <div class="col-3"></div>
                            {{-- Extra Image Here --}}
                            </div>
                      </div>
                      <div class="col-md-5 d-block ml-4">
                                <h4 class="card-title" style="border-bottom:2px solid red;"><strong>{{$product->title}}</strong></h4>
                                <p class="card-text">{!! $product->description !!}</p>
                                <div class="d-block justify-content-between align-items-center">
                                  <h5><strong>${{$product->price}}</strong></h5><br>
                                    <div class="btn-group">
                                      <a type="button" class="btn" style="background-color:#408000;color:antiquewhite;" href="{{route('products.addToCart',$product)}}">Add to cart <span data-feather="shopping-cart"></span></a>
                                    </div> 
                                </div>
                      </div>
                  </div>
                  <div class="row" style="width:100%">
                    <div class="col-12 p-4">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#additionalInformation">Additional Information</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
                            </li>
                          </ul>
                        
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div id="description" class="container tab-pane active"><br>
                              <h3>Description</h3>
                              <p>{!! $product->description !!}</p>
                            </div>
                            <div id="additionalInformation" class="container tab-pane fade"><br>
                              <h3>Additional Information</h3>
                              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div id="reviews" class="container tab-pane fade"><br>
                              <h3>Reviews</h3>
                              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                            </div>
                          </div>
                          {{-- Nav tabs Ends Here --}}
                      </div>
                  </div><br>
                  <div class="row mt-2" style="width:100%;">
                    <div class="row ml-4 mb-4 p-1" style="border-bottom:1px solid red;width:75%"><h4><strong>Product You May Like...</strong></h4></div>
                    <div class="row pl-5" style="width:100%;">
                        @foreach($products as $productall)
                        <a class="productLink" href="{{route('products.single',$productall)}}" >
                         <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3 justify-content-center p-3 ml-4 productList">
                             <div class="row justify-content-center p-1"><img class="profile-image" src="{{asset('storage/'.@$productall->thumbnail)}}" alt="" style="width:150px;height:150px;border-radius:125px;"></div>    
                             <div class="row justify-content-center p-1"><strong>{{@$productall->title}}</strong></div>
                             <div class="row justify-content-center p-1"><strong>${{@$productall->price}}</strong></div>
                             <div class="row justify-content-center">
                                <a type="button" class="btn" style="background-color:#408000;color:antiquewhite;" href="{{route('products.addToCart',$productall)}}">Add to cart <span data-feather="shopping-cart"></span></a>
                             </div>
                         </div></a>
                         @endforeach
                     </div>
                  </div>
              </div>
        </div>
@endsection