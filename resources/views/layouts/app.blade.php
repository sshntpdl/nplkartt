<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('admin_css')
    <style>
    .productLink{
        color: black;
        }

    .productLink:hover{
        color:#408000;
        }
    .productList:hover{
        background-color:whitesmoke;
    }
    .profileProductList:hover{
        background-color:white;
    }
    .cardImage:hover img{
        opacity:0.7;
    }
    .socialMedia:hover{
        background-color:rgba(0,0,0,0.2); 
    }
    .contactForm input[type=text] {
        border:none;
        background-color:#418000;
        color:white;
        border-bottom:2px solid white;
    }
    .contactForm input[type=textarea] {
        border:none;
        background-color:#418000;
        color:white;
        border-bottom:2px solid white;
    }
    .homeIcon:hover{
        color:#418000;
    }
    /* dropdown */
    /* Dropdown Button */
.dropbtn {
  color: white;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown { 
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  width: 300px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
/* drop down ends here */
    </style>
</head>
<body>
    <div id="container">
        <nav class="navbar" style="background-color:black;">
            <div class="row" style="width:100%;">
                
                    <!-- Left Side Of Navbar -->
                    <div class="col-6" style="margin-top:-1em;width:100%;height:20px;color:azure;color:white;background-color:black;">
                        <p class="pt-2"><span data-feather="phone" style="height:15px;"></span>Customer Care</p>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <div class="col-6 d-flex justify-content-end" style="margin-top:-1em;width:100%;height:20px;color:azure;color:white;background-color:black;">
                        <!-- Authentication Links -->
                        @guest
                            <div class="nav-item">
                                <a class="nav-link" style="color:white;" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" style="color:white;" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        @else
                            <div class="nav-item dropdown">
                                <a style="color:white;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('profile.show',Auth::user()->profile)}}" style='margin-top:-8px;margin-bottom:-5px;'>Profile <span data-feather="user" style="float:right;width:18px;"></span></a><hr>
                                    <a class="dropdown-item" style='margin-top:-8px;margin-bottom:-5px;' href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                   
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                        </div>
                
            </div>
        </nav>
        <div class="container-fluid" style="height:60px;z-index:55;">
            <div class="row" style="background-color:white;">
                {{-- nplkart icon --}}
                <div class="col-xs-6 col-sm-6 col-md-3 col-ls-3">
                    <span class="navbar-nav float-left" style="padding:10px;color:#408000;"><h1>NPL <i data-feather="shopping-cart"></i></h1></span>
                </div>
                {{-- Search --}}
                <div class="col-xs-12 col-sm-12 col-md-6 col-ls-6">   
                    <div class="float-left" style="width:92%;">
                        <form action="{{route('products.search')}}" method="get">
                            @csrf
                        <input type="text" placeholder="Search Here" class="form-control" name="searchValue" style="padding:10px;margin-top:10px;width:100%;">
                    </div> <button class="btn mt-2" style="background-color:#418000;"><span data-feather="search" style="color:white;"></span></button>
                </form>
                </div>
                {{-- Cart --}}
                    <div class="cartIcon col-xs-6 col-sm-6 col-md-3 col-ls-3 mt-2 d-inline-block">
                        <a href="{{url('cart')}}"><div style="float:left;color:#408000;background:#f2ffe6;border-radius:25px;border:2px solid #408000;margin-left:25px;margin-top:0.65%;width:50px;height:50px;padding:13px;" data-feather="shopping-bag"></div>
                            <span class="badge badge-danger" style="float:left;margin-top:2%;margin-left:-0.8%;">@if(Session::has('cart')) {{Session::get('cart')->getTotalQty()}} @endif</span></a>
                        <div class="cartInfo" style="padding:0px;margin-left:100px;margin-top:8px;"><b>My Shopping Bag</b><br><small>@if(Session::has('cart')) <b>{{Session::get('cart')->getTotalQty()}}</b> @endif Items in Bag</small></div>
                    </div>
            </div>
        {{-- Category Header Started --}}
            <div class="row" style="background-color:white;">
                <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3 ml-4 mr-xs-2 mr-sm-2 dropdown">
                    <button style="border:none;width:100%;background-color:#408000;border-radius:9px;color:white;padding:8px;"><h5><strong>All Categories</strong><span class="float-right" data-feather="menu"></span></h5></button>
                    <div class="dropdown-content">
                            @foreach(App\Category::all() as $category)
                            <a href="{{route('products.category',['categoryValue'=>@$category->title])}}" @if(isset($categoryValue) && ($categoryValue==$category->title)) style="color:green;text-decoration:underline;font-weight:bold;font-size:1.3em;" @else style="color:black;"@endif>
                                {{@$category->title}}
                            </a>
                            @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-ls-1 p-2 d-flex justify-content-center"><a class="productLink" href="{{url('/')}}"><h6>HOME</h6></a></div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-ls-1 p-2 d-flex justify-content-center"><a class="productLink" href="{{url('products')}}"><h6>SHOP</h6></a></div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-ls-1 p-2 d-flex justify-content-center"><a class="productLink" href="{{url('cart')}}"><h6>CART</h6></a></div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-ls-1 p-2 d-flex justify-content-center"><a class="productLink" href="{{url('checkout')}}"><h6>CHECKOUT</h6></a></div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-ls-2 p-2 d-flex justify-content-center"><a class="productLink" href="{{url('contactUs')}}"><h6>CONTACT US</h6></a></div>
            </div>
        {{-- Category Header Ends Here --}}
        <div class="row py-2">
                <div class="col-md-9">
                    @if(session()->has('message'))
                        <p class="alert alert-success">
                            {{ session()->get('message') }}
                        </p>
                    @endif
                </div>
              </div>
              {{-- Contents Starts Here --}}
            <div class="row py-5">
                @yield('content')
            </div>
            {{-- Contents Ends Here --}}
            {{-- Footer Started --}}
            <footer>
                <div class="row">
                    
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="font-size:1.2em;background-color:#333333;color:#999999;">
                            <h4 class="pt-5" style="color:whitesmoke;"><strong>Contact Us</strong></h4>
                            <p>Contrary to popular belief, 
                                Lorem Ipsum is not simply random text. 
                                It has root Contrary to popula Contrary.
                            </p>
                            <p><span data-feather="phone" style="color:#408000;"></span> +1215131516</p>
                            <p><span data-feather="mail" style="color:#408000;"></span> vasma@gmail.com</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pb-5" style="font-size:1.2em;background-color:#333333;color:#999999;">
                            <h4 class="pt-5" style="color:whitesmoke;"><strong>INFORMATION</strong></h4>
                            <ul>
                                <li class="infoList">Home</li>
                                <li class="infoList">Shop</li>
                                <li class="infoList">Cart</li>
                                <li class="infoList">Checkout</li>
                                <li class="infoList">Contact Us</li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="font-size:1.2em;background-color:#333333;color:#999999;">
                            <h4 class="pt-5" style="color:whitesmoke;"><strong>Follow Us</strong></h4>
                            <ul class="list-inline">
                                <li class="list-inline-item listIcon"><span data-feather="facebook"></span></li>
                                <li class="list-inline-item listIcon"><span data-feather="twitter"></span></li>
                                <li class="list-inline-item listIcon"><span data-feather="instagram"></span></li>
                                <li class="list-inline-item listIcon"><span data-feather="linkedin"></span></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="background-color:#333333;color:#999999;">
                            <h4 class="pt-5" style="color:whitesmoke;"><strong>Opening Hours</strong></h4>
                            <ul style="list-style-type:none;margin-left:-35px;">
                                    <li class="infoList">Sun-Thurs <span class="float-right">9:00 am - 5:00 pm</span></li>
                                    <li class="infoList">Friday <span class="float-right">9:00 am - 3:00 pm</span></li>
                                    <li class="infoList">Saturday <span class="float-right">Closed</span></li>
                            </ul>
                        </div>
                </div>
                {{-- Copyright Section Starts Here --}}
                <div class="row">
                    <div class="col-12 d-flex justify-content-center"style="background-color:#262626;color:white;padding:10px;">
                        Copyright © 2019 NPLKart. All Rights Reserved
                    </div>
                </div>
            </footer>
            {{-- footer Ends Here --}}
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    @yield('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
        $('#sortby').on('change', function() {
            $('#sortForm').submit();
              });
        });
    </script>
</body>
</html>
