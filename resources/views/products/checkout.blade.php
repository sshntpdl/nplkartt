@extends('layouts.app')
@section('content')

<div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">{{$cart->getTotalQty()}}</span>
          </h4>
          <ul class="list-group mb-3">
            @foreach($cart->getContents() as $slug=> $product)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
              <h6 class="my-0">{{$product['product']->title}}</h6>
                <small class="text-muted">{{$product['qty']}}</small>
              </div>
              <span class="text-muted">${{$product['price']}}</span>
            </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>{{$cart->getTotalPrice()}}</strong>
            </li>
          </ul>

          <form class="card p-2">
              @csrf
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing and Shipping address</h4>
        <form class="needs-validation" novalidate="" action="{{route('checkout.store')}}" method="POST">
              @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="" value="" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                @if($errors->has('firstName'))
                  <div class="alert alert-danger">
                    {{$errors->first('firstName')}}
                  </div>
                @endif
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="" required="">
                @if($errors->has('lastName'))
                  <div class="alert alert-danger">
                    {{$errors->first('lastName')}}
                  </div>
                @endif
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" name="userName" class="form-control" id="username" placeholder="Username" required="">
                @if($errors->has('userName'))
                  <div class="alert alert-danger">
                    {{$errors->first('userName')}}
                  </div>
                @endif
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
              @if($errors->has('email'))
                  <div class="alert alert-danger">
                    {{$errors->first('email')}}
                  </div>
              @endif
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" name="address1" class="form-control" id="address" placeholder="1234 Main St" required="">
              @if($errors->has('address1'))
                  <div class="alert alert-danger">
                    {{$errors->first('address1')}}
                  </div>
              @endif
            </div>

            <div class="mb-3">
              <label for="address2">Address Line 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" name="address2" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select name="country" class="custom-select d-block w-100" id="country" required="">
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select name="state" class="custom-select d-block w-100" id="state" required="">
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" name="zip" class="form-control" id="zip" placeholder="" required="">
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            
           <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Checkout as Guest.</label>
            </div>

            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        
      </div>
      </div>
@endsection
