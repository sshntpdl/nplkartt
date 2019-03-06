@extends('layouts.app')
@section('content')
<div class="container-fluid" style="width:100%;margin-top:-4.45em;">
        <div id="row demo " style="width:102.25%;margin-left:-1em;" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                      </ul>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="{{asset('images/shoes.jpg')}}" alt="Los Angeles"  height="400">
                          <div class="carousel-caption">
                            <h3>Los Angeles</h3>
                            <p>We had such a great time in LA!</p>
                          </div>   
                        </div>
                        <div class="carousel-item">
                          <img src="{{asset('images/shoe2.jpg')}}" alt="Chicago"  height="400">
                          <div class="carousel-caption">
                            <h3>Chicago</h3>
                            <p>Thank you, Chicago!</p>
                          </div>   
                        </div>
                        <div class="carousel-item">
                          <img src="{{asset('images/shirt.jpg')}}" alt="New York"  height="400">
                          <div class="carousel-caption">
                            <h3>New York</h3>
                            <p>We love the Big Apple!</p>
                          </div>   
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images/coat.jpg')}}" alt="New York" height="400">
                            <div class="carousel-caption">
                                <h3>New York</h3>
                                <p>We love the Big Apple!</p>
                            </div>   
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                      </a>
                      <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                      </a>        
        </div>
    <div class="row shadow-sm" style="width:102.25%;background-color:white;">
        <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3" style="width:100%;">
           <div class="row mt-2"> 
            <div class="col-2 mt-1 ml-4 pl-2"><span class="homeIcon" data-feather="truck" style="height:40px;width:40px;"></span></div>
            <div class="col-8 p-1" style="width:100%;"><h5><strong>Free Shipping & Return</strong></h5><h6>Free Shipping on All Orders</h6></div>
           </div>
        </div>
        <div class=" col-xs-12 col-sm-12 col-md-3 col-ls-3" style="width:100%;">
            <div class="row mt-2"> 
                <div class="col-2 mt-1 ml-4 pl-2"><span class="homeIcon" data-feather="dollar-sign" style="height:40px;width:40px;"></span></div>
                <div class="col-8 p-1" style="width:100%;"><h5><strong>Money Back</strong></h5><h6>30 Days Money Back Guarantee</h6></div>
            </div>
        </div>
        <div class=" col-xs-12 col-sm-12 col-md-3 col-ls-3" style="width:100%;">
            <div class="row mt-2"> 
                <div class="col-2 mt-1 ml-4 pl-2"><span class="homeIcon" data-feather="disc" style="height:40px;width:40px;"></span></div>
                <div class="col-8 p-1" style="width:100%;"><h5><strong>Online Support 24/7</strong></h5><h6>Online Support for 24hrs a day and Everyday in a Week </h6></div>
            </div>
        </div>
        <div class=" col-xs-12 col-sm-12 col-md-3 col-ls-3" style="width:100%;">
            <div class="row mt-2"> 
                <div class="col-2 mt-1 ml-4 pl-2"><span class="homeIcon" data-feather="help-circle" style="height:40px;width:40px;"></span></div>
                <div class="col-8 p-1" style="width:100%;"><h5><strong>Got Questions</strong></h5><h6>Send Us Your Query Here</h6></div>
            </div>
        </div>
    </div>
    <div class="row ml-4 mt-4">
        <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3">
            <div class="card" style="width: 18rem;border-radius:25px;">
                <h4 class="card-title mt-3 ml-3" style="border-bottom:1px solid red;width:90%;"><b>Categories</b></h4>
                <div class="card-body">
                  <table>
                    <tbody>
                      @foreach($categories as $category)
                        <tr><h6><a href="{{route('products.category',['categoryValue'=>@$category->title])}}" style="color:black;">{{$category->title}}</a></h6></tr><br>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
        {{-- Product Section Here  --}}
              {{-- main section starts here --}}
              <div class="col-xs-12 col-sm-12 col-md-9 col-ls-9" style="border-radius:10px;background-color:white;">
                    <div class="row" style="width:89.5%;">
                        <div class="pt-1 mt-2 col-xs-6 col-sm-6 col-md-6 col-xs-6">
                            <h4 style="padding:5px;border-bottom:1px solid red;"><strong>Featured Products</strong></h4>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin-top:-1.0em;">
                      @foreach($featuredproducts as $product)
                    <a class="productLink" href="{{route('products.single',$product)}}" >
                      <div class="pt-3 col-xs-6 col-sm-6 col-md-3 col-xs-3 d-flex float-left cardImage">
                        <div class="card">
                          <img class="card-img-top" style="height:200px;width:100%;" src="{{asset('storage/'.$product->thumbnail)}}">
                            <div class="card-body" style="padding:1px;">
                              <div class="container">
                                <div class="row justify-content-center "><h5 class="card-title">{{$product->title}}</h5></div>
                                <div class="row justify-content-center "><h6 class="card-title">
                                    @if(($product->discount_price)!='0') 
                                    <h6 class="card-title">
                                      <strong><span style="text-decoration:line-through red;">${{$product->price}}</span>  ${{$product->price - $product->discount_price}}</strong>
                                    </h6>
                                  @else
                                    <h6 class="card-title">
                                      <strong>${{$product->price}}</strong>
                                    </h6>
                                  @endif  
                                </h6></div>
                                <div class="row justify-content-center mb-3"><a type="button" class="btn" style="background-color:#408000;color:antiquewhite" href="{{route('products.addToCart',$product)}}">Add to carts</a></div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </a>
                      @endforeach
                    
                    </div>

                    {{-- Next row --}}

                    <div class="row" style="width:89.5%;">
                        <div class="pt-1 mt-2 col-xs-6 col-sm-6 col-md-6 col-xs-6">
                            <h4 style="padding:5px;border-bottom:1px solid red;"><strong>Recent Arrivals</strong></h4>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin-top:-1.0em;">
                      @foreach($recentproducts as $product)
                    <a class="productLink" href="{{route('products.single',$product)}}" >
                      <div class="pt-3 col-xs-6 col-sm-6 col-md-3 col-xs-3 d-flex float-left cardImage">
                        <div class="card">
                          <img class="card-img-top" style="height:200px;width:100%;" src="{{asset('storage/'.$product->thumbnail)}}">
                            <div class="card-body" style="padding:1px;">
                              <div class="container">
                                <div class="row justify-content-center "><h5 class="card-title">{{$product->title}}</h5></div>
                                <div class="row justify-content-center "><h6 class="card-title">
                                    @if(($product->discount_price)!='0') 
                                    <h6 class="card-title">
                                      <strong><span style="text-decoration:line-through red;">${{$product->price}}</span>  ${{$product->price - $product->discount_price}}</strong>
                                    </h6>
                                  @else
                                    <h6 class="card-title">
                                      <strong>${{$product->price}}</strong>
                                    </h6>
                                  @endif  
                                </h6></div>
                                <div class="row justify-content-center mb-3"><a type="button" class="btn" style="background-color:#408000;color:antiquewhite" href="{{route('products.addToCart',$product)}}">Add to carts</a></div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </a>
                      @endforeach
                    
                    </div>
                    {{-- Next row ends here --}}
                    {{-- Next row --}}

                    <div class="row" style="width:89.5%;">
                        <div class="pt-1 mt-2 col-xs-6 col-sm-6 col-md-6 col-xs-6">
                            <h4 style="padding:5px;border-bottom:1px solid red;"><strong>Offers</strong></h4>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin-top:-1.0em;">
                    @foreach($offerproducts as $product)
                      @if(($product->discount_price)!='0')
                    <a class="productLink" href="{{route('products.single',$product)}}" >
                      <div class="pt-3 col-xs-6 col-sm-6 col-md-3 col-xs-3 d-flex float-left cardImage">
                        <div class="card">
                          <img class="card-img-top" style="height:200px;width:100%;" src="{{asset('storage/'.$product->thumbnail)}}">
                            <div class="card-body" style="padding:1px;">
                              <div class="container">
                                <div class="row justify-content-center "><h5 class="card-title">{{$product->title}}</h5></div>
                                <div class="row justify-content-center "><h6 class="card-title">
                                    @if(($product->discount_price)!='0') 
                                    <h6 class="card-title">
                                      <strong><span style="text-decoration:line-through red;">${{$product->price}}</span>  ${{$product->price - $product->discount_price}}</strong>
                                    </h6>
                                  @else
                                    <h6 class="card-title">
                                      <strong>${{$product->price}}</strong>
                                    </h6>
                                  @endif
                                </div>
                                <div class="row justify-content-center mb-3"><a type="button" class="btn" style="background-color:#408000;color:antiquewhite" href="{{route('products.addToCart',$product)}}">Add to carts</a></div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </a>
                    @endif
                      @endforeach

                    </div>
                    {{-- Next row ends here --}}
                                        

                    {{-- Next row --}}

                    <div class="row" style="width:89.5%;">
                        <div class="pt-1 mt-2 col-xs-6 col-sm-6 col-md-6 col-xs-6">
                            <h4 style="padding:5px;border-bottom:1px solid red;"><strong>Top Sellar</strong></h4>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin-top:-1.0em;">
                      @foreach($popularProducts as $product)
                    <a class="productLink" href="{{route('products.single',$product)}}" >
                      <div class="pt-3 col-xs-6 col-sm-6 col-md-3 col-xs-3 d-flex float-left cardImage">
                        <div class="card">
                          <img class="card-img-top" style="height:200px;width:100%;" src="{{asset('storage/'.$product->thumbnail)}}">
                            <div class="card-body" style="padding:1px;">
                              <div class="container">
                                <div class="row justify-content-center "><h5 class="card-title">{{$product->title}}</h5></div>
                                <div class="row justify-content-center "><h6 class="card-title">
                                    @if(($product->discount_price)!='0') 
                                    <h6 class="card-title">
                                      <strong><span style="text-decoration:line-through red;">${{$product->price}}</span>  ${{$product->price - $product->discount_price}}</strong>
                                    </h6>
                                  @else
                                    <h6 class="card-title">
                                      <strong>${{$product->price}}</strong>
                                    </h6>
                                  @endif
                                </div>
                                <div class="row justify-content-center mb-3"><a type="button" class="btn" style="background-color:#408000;color:antiquewhite" href="{{route('products.addToCart',$product)}}">Add to carts</a></div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </a>
                      @endforeach
                    
                    </div>
                    {{-- Next row ends here --}}

                    
                </div>
                {{-- main section ends here --}}
    </div>
</div>
@endsection
