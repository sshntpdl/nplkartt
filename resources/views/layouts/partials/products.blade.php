
   

    <div class="container-fluid" style="margin-top:-3.8em;">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3">
          <div class="card" style="width: 18rem;border-radius:25px;">
            <h5 class="card-title" style="border-radius:25px;padding:20px;width:100%;background-color:#408000;color:white;">Card title</h5>
            <div class="card-body">
              <table>
                <tbody>
                  @foreach($categories as $category)
                    <tr><h5><a href="#" style="color:black;">{{$category->title}}</a></h5></tr><br>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
      {{-- main section starts here --}}
        <div class="col-xs-12 col-sm-12 col-md-9 col-ls-9 shadow-sm" style="border-radius:10px;background-color:white;border:1px solid rgba(0,0,0,0.2);">
          <h6 class="pt-4 pl-3">Showing 9 of 12 results</h6>
          <div class="row d-flex justify-content-center mb-4">
            @foreach($products as $product)
          <a class="productLink" href="{{route('products.single',$product)}}" >
            <div class="pt-3 pl-1 col-xs-6 col-sm-6 col-md-4 col-xs-4 d-flex float-left cardImage">
              <div class="card ml-3">
                <img class="card-img-top p-3" style="height:300px;width:100%;" src="{{asset('storage/'.$product->thumbnail)}}">
                  <div class="card-body" style="padding:1px;">
                    <div class="container">
                      <div class="row justify-content-center "><h5 class="card-title">{{$product->title}}</h5></div>
                      <div class="row justify-content-center "><h6 class="card-title"><strong>${{$product->price}}</strong></h6></div>
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
    