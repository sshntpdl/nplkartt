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
        <div class="row m-2 shadow mt-4" style="border-radius:15px;">          
              <h4 class="ml-4 mt-3" style="border-bottom:1px solid red;"> Order Information</h4>
              <div class="container">
                  <div class="row ml-4 mt-3">
                      <div class="col-6">
                          <span><strong>Customer Name: </strong> {{@$order->customer_name}}</span><br>
                          <span><strong>Customer Address: </strong> {{@$order->address1}}</span> <br>
                          <span><strong>Customer Phone: </strong> {{@$order->phone1}}</span> 
                      </div>
                      <div class="col-6">
                            <span><strong>Order Id: </strong> {{@$order->id}}</span> <br>
                      </div>
                  </div>
                  <div class="row mt-4 ml-4">
                      <table class="table">
                          <thead>
                              <th>#</th>
                              <th>Product Name</th>
                              <th>Product Quantity</th>
                              <th>Product Price</th>
                              <th>Total Price</th>
                          </thead>
                          <tbody>
                              <tr>
                                  <td></td>
                                  <td>{{@$order->product_name}}</td>
                                  <td>{{@$order->qty}}</td>
                                  <td>Rs. {{($order->price)/($order->qty)}}</td>
                                  <td>Rs. {{$order->price}}</td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>Grand Total:</td>
                                  <td><b>Rs. {{$order->price}}</b></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="row mt-4 ml-4">
                      <p>Thank you for visiting.Hope to see you again.</p>
                  </div>
                  <div class="row mt-4 d-flex float-right m-2">
                    <a href="{{route('admin.generate-bill',['download'=>'pdf','order'=>$order])}}">  
                    <button class="btn btn-warning">
                          <i class="fas fa-print"> Print</i>
                      </button>
                    </a>
                  </div>
              </div>
        </div>
    </div>
</body>
</html>