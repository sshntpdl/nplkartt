
   

    <div class="container-fluid" style="margin-top:-3.8em;">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3">
        
         <div class="row-d-flex justify-content-center ml-1 mt-3 mr-3 p-2" style="border-radius:15px;background-color:white;">
          <h4 style="border-bottom:1px solid red;"><b>Top Brands</b></h4>  
          @foreach($brandNames as $brandName)
            @if(isset($brandName))
             <div class="p-1 pl-4"><a href="{{route('products.brand',['brandValue'=>@$brandName])}}" @if(isset($brandValue) && ($brandValue==$brandName)) style="color:green;text-decoration:underline;font-weight:bold;font-size:1.3em;" @else style="color:black;"@endif>{{@$brandName}}</a></div>
            @endif
          @endforeach  
         </div>
          <div class="row d-flex justify-content-center ml-1 mt-2 mr-3 p-2" style="border-radius:15px;background-color:white;">
          <h4 style="border-bottom:1px solid red;width:100%;"><b>Price Range</b></h4><br>
          <form action="{{route('products.range')}}" method="get">
              @csrf
            <section class="range-slider">
            <strong><span class="rangeValues"></span></strong><br><br>
            <input name="rangeValue1" @if((@$rangeValue1)) value="{{@$rangeValue1}}" @else value="0" @endif min="0" max="5000" step="100" type="range">
            <input name="rangeValue2" @if((@$rangeValue2)) value="{{@$rangeValue2}}" @else value="500" @endif min="500" max="5000" step="100" type="range">
            </section>
            <button class="btn btn-success" type="submit">Get Products</button>
          </form>
          </div>

          <div class="card mt-3" style="width: 18rem;border-radius:25px;">
              <h4 class="card-title mt-3 ml-3" style="border-bottom:1px solid red;width:90%;"><b>Categories</b></h4>
              <div class="card-body">
                <table>
                  <tbody>
                    @foreach($categories as $category)
                  <tr><h6><a href="{{route('products.category',['categoryValue'=>@$category->title])}}" @if(isset($categoryValue) && ($categoryValue==$category->title)) style="color:green;text-decoration:underline;font-weight:bold;font-size:1.3em;" @else style="color:black;"@endif>
                    <b>{{$category->title}}</b></a>
                  <button data-toggle="collapse" class="btn float-right" data-target="#demo-{{$category->id}}" style="padding:0px;margin-top:-0.5em;"><span data-feather="arrow-down-circle" style="height:20px;"></span></button>
                    </h6>
                    <ul id="demo-{{$category->id}}" class="collapse">
                    @foreach($category->parents as $child)
                      <li><a href="{{route('products.category',['categoryValue'=>@$child->title])}}" @if(isset($categoryValue) && ($categoryValue==$category->title)) style="color:green;text-decoration:underline;font-weight:bold;font-size:1.3em;" @else style="color:black;"@endif>{{@$child->title}}</a></li>
                    @endforeach
                    </ul>
                  </tr><br>

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        
      {{-- main section starts here --}}
        <div class="col-xs-12 col-sm-12 col-md-9 col-ls-9" style="border-radius:10px;background-color:white;">
          <div class="row pt-4">
              
                @if(isset($brandValue))
                <h4 class="mr-auto ml-4" style="border-bottom:1px solid red;width:50%;">
                    <strong>
                  {{@$brandValue}} Products
                    </strong>
                </h4>
                @elseif(isset($categoryValue))
                  <h4 class="mr-auto ml-4" style="border-bottom:1px solid red;width:50%;">
                    <strong>
                  {{@$categoryValue}} Products
                    </strong>
                  </h4>
                @elseif(isset($value))
                <h5 class="mr-auto ml-4">
                    <strong>
                      Results for '{{@$value}}' are:
                    </strong>
                  </h5>
                @else
                @endif
               
              <form id="sortForm" name="sortForm" method="GET" class="ml-auto mr-3" action="{{route('products.sort')}}">
                @csrf
                <select name="sortby" id="sortby" class="form-control">
                  <option value="recentby" @if(isset($sortValue) && $sortValue == 'recentBy') {{'selected'}} @endif>Sort By Recent</option>
                  <option value="popularity" @if(isset($sortValue) && $sortValue == 'popularity') {{'selected'}} @endif>Sort By Popularity</option>
                  <option value="offers" @if(isset($sortValue) && $sortValue == 'offers') {{'selected'}} @endif>Sort By Offers</option>
                </select>
              </form>
          </div>
          <div class="row d-flex justify-content-center mb-4">
            @foreach($products as $product)
          <a class="productLink" href="{{route('products.single',$product)}}" >
            <div class="pt-3 pl-1 col-xs-6 col-sm-6 col-md-3 col-xs-3 d-flex float-left cardImage">
              <div class="card" style="width:100%;">
                  @if(($product->discount_price)!='0')
                    <div style="padding:2px;margin-bottom:-4em;position:absolute;z-index:50;right:10px;top:10px;background-color:red;color:white;"><h5>$ {{@$product->discount_price}}</h5></div>
                  @endif
                  @if(($product->assurance)!='0')
                    <div class="d-flex justify-content-center" style="padding:2px;margin-bottom:0em;position:absolute;z-index:50;bottom:8.1em;background-color:yellowgreen;color:white;width:100%;"><h5><strong>NPL<span data-feather="shopping-cart"></span> Assured</strong></h5></div>
                  @endif
                <img class="card-img-top" style="height:200px;width:100%;" src="{{asset('storage/'.$product->thumbnail)}}"> 
                <div class="card-body" style="padding:1px;">
                    <div class="container">
                      <div class="row justify-content-center "><h5 class="card-title">{{$product->title}}</h5></div>
                      <div class="row justify-content-center ">
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

          <div class="row">
            <div class="col-md-12">
              {{$products->links()}}
            </div>
          </div> 
        </div>
      {{-- main section ends here --}}
      </div>  
    </div>
          {{-- range script here --}}
          <script type="text/javascript"> 
            function getVals(){
                // Get slider values
                var parent = this.parentNode;
                var slides = parent.getElementsByTagName("input");
                  var slide1 = parseFloat( slides[0].value );
                  var slide2 = parseFloat( slides[1].value );
                // Neither slider will clip the other, so make sure we determine which is larger
                if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
                
                var displayElement = parent.getElementsByClassName("rangeValues")[0];
                    displayElement.innerHTML = "$ " + slide1 + " - $" + slide2 + " ";
              }
              
              window.onload = function(){
                // Initialize Sliders
                var sliderSections = document.getElementsByClassName("range-slider");
                    for( var x = 0; x < sliderSections.length; x++ ){
                      var sliders = sliderSections[x].getElementsByTagName("input");
                      for( var y = 0; y < sliders.length; y++ ){
                        if( sliders[y].type ==="range" ){
                          sliders[y].oninput = getVals;
                          // Manually trigger event first time to display values
                          sliders[y].oninput();
                        }
                      }
                    }
              }
              </script>
            {{-- range script upto here  --}}
    