@extends('layouts.app')
@section('content')
        <div class="container">
          <div class="row shadow-sm " style="background-color:white;border-radius:15px;">
                  <div class="row p-5 mt-1">
                      <div class="col-md-5">
                            <img id="myImg" class="img-thumbnail p-2" data-toggle="modal" data-target="#myModal" src="{{asset('storage/'.$product->thumbnail)}}">
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                                <div class="modal-dialog" style="margin-top:6em;">
                                    <div class="modal-content">
                                      <img src="{{asset('storage/'.$product->thumbnail)}}" width="100%" height="100%" alt="">
                                    </div>
                                  </div>
                            </div>
                            @if($product->extraphoto1!=null || $product->extraphoto2!=null || $product->extraphoto3!=null || $product->extraphoto4!=null)
                            <div class="row d-flex justify-content-center mt-2 p-2 shadow" style="background-color:whitesmoke;border-radius:15px;height:8em;">
                              @if($product->extraphoto1!=null)
                              <div class="col-3" style="width:100%;">
                                <img id="myImg1" class="img-thumbnail p-2" data-toggle="modal" data-target="#myModal-1" src="{{asset('storage/'.$product->extraphoto1)}}" style="height:6em;">
                                 <!-- The Modal -->
                              <div id="myModal-1" class="modal">
                                <div class="modal-dialog" style="margin-top:6em;">
                                    <div class="modal-content">
                                      <img src="{{asset('storage/'.$product->extraphoto1)}}" width="100%" height="100%" alt="">
                                    </div>
                                  </div>
                              </div>
                              </div>
                              @endif
                            {{-- extra photo 2 --}}
                            @if($product->extraphoto2!=null)
                              <div class="col-3" style="width:100%;">
                                <img id="myImg1" class="img-thumbnail p-2" data-toggle="modal" data-target="#myModal-2" src="{{asset('storage/'.$product->extraphoto2)}}" style="height:6em;">
                                 <!-- The Modal -->
                              <div id="myModal-2" class="modal">
                                <div class="modal-dialog" style="margin-top:6em;">
                                    <div class="modal-content">
                                      <img src="{{asset('storage/'.$product->extraphoto2)}}" width="100%" height="100%" alt="">
                                    </div>
                                  </div>
                              </div>
                              </div>
                              @endif
                            {{-- extra photo 2 --}}
                            @if($product->extraphoto3!=null)
                              <div class="col-3" style="width:100%;">
                                <img id="myImg1" class="img-thumbnail p-2" data-toggle="modal" data-target="#myModal-3" src="{{asset('storage/'.$product->extraphoto3)}}" style="height:6em;">
                                 <!-- The Modal -->
                              <div id="myModal-3" class="modal">
                                <div class="modal-dialog" style="margin-top:6em;">
                                    <div class="modal-content">
                                      <img src="{{asset('storage/'.$product->extraphoto3)}}" width="100%" height="100%" alt="">
                                    </div>
                                  </div>
                              </div>
                              </div>
                              @endif
                            {{-- extra photo 2 --}}
                            @if($product->extraphoto4!=null)
                              <div class="col-3" style="width:100%;">
                                <img id="myImg1" class="img-thumbnail p-2" data-toggle="modal" data-target="#myModal-4" src="{{asset('storage/'.$product->extraphoto4)}}" style="height:6em;">
                                 <!-- The Modal -->
                              <div id="myModal-4" class="modal">
                                <div class="modal-dialog" style="margin-top:6em;">
                                    <div class="modal-content">
                                      <img src="{{asset('storage/'.$product->extraphoto4)}}" width="100%" height="100%" alt="">
                                    </div>
                                  </div>
                              </div>
                              </div>
                              @endif
                            </div>
                          @endif
                      </div>
                      <div class="col-md-5 d-block ml-4">
                                <h4 class="card-title" style="border-bottom:2px solid red;"><strong>{{$product->title}}</strong></h4>
                                <p class="card-text">{!! $product->features !!}</p>
                                <div class="d-block justify-content-between align-items-center">
                                  <h5><strong>${{$product->price}}</strong></h5>
                                  <span>
                                    @for($i=1;$i<=@$product->ratings;$i++)
                                      <i data-feather="star" style="color:gold;"></i>
                                    @endfor
                                  </span><br><br>
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
                              <a class="nav-link" data-toggle="tab" href="#additionalInformation">Features</a>
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
                              <h3>Features</h3>
                              <p>{!! $product->features !!}</p>
                            </div>
                            <div id="reviews" class="container tab-pane fade"><br>
                              <h3>Reviews</h3>
                              <div class="container ml-1">
                                @if(count($reviews)>0)
                                  @foreach($reviews as $review)
                                  <div class="row ml-1 media border p-3 col-11 mt-2"  style="background-color:azure;width:88.6%;">
                                    <img src="{{asset('images/user22.png')}}" class="mr-2 rounded-circle" style="width:60px;">
                                    <div class="media-body">
                                      <h6><b>{{@$review->user_name}}</b><small><i>Posted on {{@$review->created_at}}</i></small></h6>
                                    @if(Auth::user()!=null && Auth::user()->email==$review->user_email)
                                      <a class="float-right" href="{{route('products.deleteReview',['reviewId'=>$review->id])}}"><button class="btn" style="margin-top:-3.5em;"><span data-feather="trash-2" style="height:1.5em;"></span></button></a>
                                    @endif
                                    <p>{{@$review->reviews}}</p>
                                    <p><b>Ratings:</b>
                                      <span>
                                          @for($i=1;$i<=@$review->ratings;$i++)
                                            <i data-feather="star" style="color:gold;"></i>
                                          @endfor
                                        </span>
                                    </p>      
                                    </div>
                                  </div>
                                  @endforeach
                                @else
                                  <p>No Reviews Till Now.</p>
                                @endif
                                  @if(Auth::user()!=null && in_array(Auth::user()->email,$customers))
                                  <form action="{{route('products.review')}}" method="get">
                                    @csrf
                                    <div class="row form-group col-11 mt-4" >
                                      <label for="comment"><b>Give Your Review on Product:</b></label>
                                      <textarea class="form-control" rows="2" id="comment" name="review" required=""></textarea>
                                      <input name="productId" value="{{@$product->id}}" type="hidden" >
                                    </div>
                                    <div class="row form-group col-11">
                                      <label for="ratings"><b>Ratings :</b></label>
                                      <input class="col-6 ml-2" type="number" name="ratings" min="1" max="5" value="4">
                                      <input name="userEmail" value="{{Auth::user()->email}}" type="hidden" >
                                      <input name="userName" value="{{Auth::user()->profile->name}}" type="hidden" >
                                    </div>
                                  
                                    <div class="form-group row ml-1">
                                      <button class="btn btn-outline-success" >Post</button>
                                    </div>
                                  </form>
                                  @endif
                              </div>
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