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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-laravel" style="height:30px;color:azure;color:white;background-color:black;">
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <p class="pt-2"><span data-feather="phone" style="height:15px;"></span>Customer Care</p>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
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
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="lower-header" style="height:75px;">
            <div class="col-sm-4 col-md-6 col-ls-6">
                <span class="navbar-nav float-left" style="padding:15px;color:yellowgreen;"><h1>NPL <i data-feather="shopping-cart"></i></h1></span>
            </div>   
            <div class="float-left col-sm-4 col-md-6 col-ls-6">
                <input type="text" placeholder="Search Here" class="form-control col-ls-8" style="padding:10px;margin-left:20%;margin-top:10px;">
            </div> <span class="float-left" data-feather="search" style="margin-left:9%;margin-top:10px;background:yellowgreen;height:45px;width:40px;padding:5px;border-radius:5px;"></span>
            <div class="float-left" style="background:yellowgreen;border-radius:25px;margin-left:9%;margin-top:0.65%;width:55px;height:55px;size:2px;padding:10px;" data-feather="shopping-bag"></div><span class="badge badge-danger" style="margin-top:0.1%;margin-left:-0.8%;">0</span>
            <div style="margin-top:-0.5%;"><b>My Shopping Bag</b><br><small>No Items in Bag</small></div>
        </div><hr>

    
        <div class="container">
          <div class="row py-2">
            <div class="col-md-9">
                @if(session()->has('message'))
                    <p class="alert alert-success">
                        {{ session()->get('message') }}
                    </p>
                @endif
            </div>
          </div>
         </div>
        @yield('content')
    </div>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
</body>
</html>
