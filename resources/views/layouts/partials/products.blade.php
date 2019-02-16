
   

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
        @foreach($products as $product)
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="{{asset('storage/app/public/'.$product->thumbnail)}}">
              <div class="card-body">
                  <h4 class="card-title">{{$product->title}}</h4>
                <p class="card-text">{!! $product->description !!}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View Products</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Add to carts</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    