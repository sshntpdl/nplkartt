@extends('layouts.app')
@section('content')
<h2 class="pl-4 pt-4" style="margin-top:-2.5em;background:#418000;width:100%;color:white;"><strong>Cart</strong></h2><br>
@if(isset($cart) && $cart->getContents())
<div class="card table-responsive ml-2 p-2" style="margin-top:-0.5em;">
	<table class="table table-hover shopping-cart-wrap">
		<thead class="text-muted">
			<tr>
				<th scope="col" class="d-flex justify-content-center">Product</th>
				<th scope="col" width="120">Quantity</th>
				<th scope="col" width="120">Price</th>
				<th scope="col" width="200" class="text-right">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach($cart->getContents() as $slug => $product)

				<tr>
					<td>
						<figure class="media">
							<div class="img-wrap"><img src="{{asset('storage/'.$product['product']->thumbnail)}}" class="img-thumbnail img-sm" width="250px" height="250px"> </div>
							<figcaption class="media-body m-2 ml-4 p-2">
							<h6 class="title text-truncate"><strong><h4>{{$product['product']->title}}</h4></strong></h6>
							<dl class="param param-inline">
								<dt>Size: </dt>
								<dd>XXL</dd>
							</dl>
							<dl class="param param-inline">
								<dt><b>Color: </b></dt>
								<dd>Orange color</dd>
							</dl>
							</figcaption>
						</figure>
					</td>
					<td>
						<form method="POST" action="{{route('cart.update', $slug)}}" >
							@csrf
						<input type="number" name="qty" id="qty" class="form-control text-center" min="1" max="99" value="{{$product['qty']}}">
						<input type="submit" name="update" value="Update" class="btn btn-block btn-outline-success btn-round">
						</form>
					</td>
					<td>
						<div class="price-wrap">
							<span class="price">USD {{$product['price']}}</span>
							<small class="text-muted">(USD{{$product['product']->price-$product['product']->discount_price}} each)</small>
							</div> <!-- price-wrap .// -->
						</td>
						<td class="text-right">
							<form action="{{route('cart.remove', $slug)}}" method="POST" accept-charset="utf-8">
							@csrf
							<button type="submit" name="remove" class="btn btn-outline-danger" style="border:0px;"><span data-feather="x-circle"></span></button>
							<!--<input type="submit" name="remove" value="x Remove" class="btn btn-outline-danger"/>-->
							</form>
						</td>
					</tr>

				@endforeach
				<tr>
					<th colspan="2">Total Qty: </th>
					<td>{{$cart->getTotalQty()}}</td>
				</tr>
				<tr>
					<th colspan="2">Total Price: </th>
					<td>{{$cart->getTotalPrice()}}</td>
				</tr>
				<tr>
					<th colspan="2"></th>
					<td><a href="{{url('checkout')}}"><button class="btn btn-success">Checkout</button></a></td>
				</tr>
			</tbody>
		</table>
		</div> <!-- card.// -->
	@else
		<p class="alert alert-danger">No Products in the cart. <a href="{{route('products.all')}}">Buy some Products.</a> </p>
	@endif
@endsection