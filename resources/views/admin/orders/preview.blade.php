<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
{{-- font awesome --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Order Preview</title>
</head>
<body>
    <div class="container">
        <div class="row m-2 shadow" style="border-radius:15px;">          
              <h4 class="ml-4 mt-3" style="border-bottom:1px solid red;">@if(@$sortValue) {{@$sortValue}} @else All @endif Order Information</h4>

            <div class="modal-body">
              
              <div class="col-12">
                <h4 class="mr-5 ml-2"><strong></strong></h4>
                {{-- table started --}}
                <div class="col-12">
                  <table class="table" style="width:100%;">
                    <thead>
                      <th>#</th>
                      <th>Customer Name</th>
                      <th>Product Name</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>City</th>
                      <th>Address</th>
                      <th>Phone No.</th>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                      @foreach(@$orders as $order)
                        <tr>
                          <td>{{@$i}}</td>
                          <td>{{@$order->customer_name}}</td>
                          <td>{{@$order->product_name}}</td>
                          <td>{{@$order->qty}}</td>
                          <td>{{@$order->price}}</td>
                          <td>{{@$order->city}}</td>
                          <td>{{@$order->address1}},{{@$order->address1}}</td>
                          <td>{{@$order->phone1}},{{@$order->phone2}}</td>
                        </tr>
                        @php $i=$i+1; @endphp
                      @endforeach
                      <tr></tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><a style="color:black;" href="{{ route('admin.generate-pdf',['download'=>'pdf','sortValue'=>$sortValue]) }}"><button class="btn btn-warning"><i class="fas fa-print" style="font-size:15px;">Print</i> </button></a></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              <!-- table closed -->
              </div>
            </div>
              
        </div>
    </div>
</body>
</html>