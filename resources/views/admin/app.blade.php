<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {!! Charts::styles() !!}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
    <style>
        @mixin range-slider($width, $height, $input-top, $input-bg-color, $input-thumb-color, $float:none, $input-height:20px, $input-border-radius:14px) {
        position: relative;
        width: $width;
        height: $height;
        float: $float;
        text-align: center;
            
        input[type="range"] {
            pointer-events: none;
            position: absolute;
            -webkit-appearance: none;
            -webkit-tap-highlight-color: rgba(255, 255, 255, 0);    
            border: none;
            border-radius: $input-border-radius;
            background: $input-bg-color;
            box-shadow: inset 0 1px 0 0 darken($input-bg-color,15%), inset 0 -1px 0 0 darken($input-bg-color,10%);
            -webkit-box-shadow: inset 0 1px 0 0 darken($input-bg-color,15%), inset 0 -1px 0 0 darken($input-bg-color,10%);
            overflow: hidden;
            left: 0;
            top: $input-top;
            width: $width;
            outline: none;
            height: $input-height;
            margin: 0;
            padding: 0;
        }  
        
        input[type="range"]::-webkit-slider-thumb {
            pointer-events: all;
            position: relative;
            z-index: 1;
            outline: 0;    
            -webkit-appearance: none;
            width: $input-height;
            height: $input-height;
            border: none;
            border-radius: $input-border-radius;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, lighten($input-thumb-color,60%)), color-stop(100%, $input-thumb-color)); /* android <= 2.2 */
            background-image: -webkit-linear-gradient(top , lighten($input-thumb-color,60%) 0, $input-thumb-color 100%); /* older mobile safari and android > 2.2 */;
            background-image: linear-gradient(to bottom, lighten($input-thumb-color,60%) 0, $input-thumb-color 100%); /* W3C */
        }
        
        input[type="range"]::-moz-range-thumb {
            pointer-events: all;
            position: relative;
            z-index: 10;
            -moz-appearance: none;
            width: $input-height;
            height: $input-height;
            border: none;
            border-radius: $input-border-radius;
            background-image: linear-gradient(to bottom, lighten($input-thumb-color,60%) 0, $input-thumb-color 100%); /* W3C */
        }

        input[type="range"]::-ms-thumb {
            pointer-events: all;
            position: relative;
            z-index: 10;
            -ms-appearance: none;
            width: $input-height;
            height: $input-height;
            border-radius: $input-border-radius;
            border: 0;
            background-image: linear-gradient(to bottom, lighten($input-thumb-color,60%) 0, $input-thumb-color 100%); /* W3C */
        }
        
        input[type=range]::-moz-range-track {
            position: relative;
            z-index: -1;
            background-color: rgba(0, 0, 0, 1);
            border: 0;
        }
        
        input[type=range]:last-of-type::-moz-range-track {
            -moz-appearance: none;
            background: none transparent;
            border: 0;
        } 
        
        input[type=range]::-moz-focus-outer {
            border: 0;
        }
        }

        section.range-slider {
         range-slider(300px, 300px, 50px, #F1EFEF, #413F41, left);
        }

    </style>
</head>
<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                      <h1 class="h2">Dashboard</h1>
                    </div>


                  <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
                        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.dashboard')}}">Company name</a>
                        <ul class="navbar-nav px-3">
                            <li><a class="nav-link pr-3" href="{{url('/')}}">Home</a></li>
                            <li class="nav-item text-nowrap dropdown">
                                <a class="nav-link dropdown-toggle pr-3" href="#" id="navbardrop" data-toggle="dropdown">
                                    <span data-feather="bell"></span>
                                    @if(auth()->user()->unreadNotifications->count())
                                        <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                                    @endif
                                </a>    
                                <div class="dropdown-menu">
                                        <a class="dropdown-item" style="color:green;" href="{{route('markRead')}}"><u>Mark All As Read</u></a>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <a class="dropdown-item"  style="background-color:lightgray;" href="#">{{ $notification->data['data'] }}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </nav>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                    <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                              @yield('breadcrumbs')
                                            </ol>
                                    </nav>
                            </div>
                            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                                @include('admin.partials.navbar')
                            </nav>
                            <div class="col-md-12">
                                @yield('content')
                            </div>
                      </div>
                    </div>
    </main>
    
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
     <!-- Bootstrap core JavaScript
    ================================================== -->
    @yield('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
        $('#sortby').on('change', function() {
            $('#sortForm1').submit();
              });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#sortby2').on('change', function() {
            $('#sortForm2').submit();
              });
        });
    </script>
</body>
</html>
