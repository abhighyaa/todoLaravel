<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
    
    </script>
    <!-- <script src="jquery-3.3.1.min.js"></script> -->
   
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                @if (Auth::check())
                    <a href="#">
                        <img src={{ url('images/menu1.png')}} width="30" height="30" id="toggle">
                    </a>
                    &nbsp;&nbsp;
                @endif
                <a class="navbar-brand" href="{{ url('/home') }}">
                    ToDo App
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        @if (Auth::check())
                            <div id="searchbar">
                                <input id="search" class="rounded" style="border:none" placeholder="Search">
                                <img src={{url('images/search.png')}} width="30" height="30">
                            </div>
                        @endif
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
                            <li>
                                <a href="/notifications"><img src={{ url('images\notification2.png')}} class="mt-2" width="30" height="30"></a>
                                <span class="badge badge-danger">
                                @if($count!=0)
                                    {{$count}}
                                @endif
                                </span>
                            </li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li>
                                <a href="/task/create"><img src={{url("images/create.jpeg")}} class="mt-2" width="30" height="30"></a>
                            </li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/{{ Auth::user()->avatar }}" width="30" height="30" class="circle"> <span class="caret"></span> 
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="/editprofile" class="dropdown-item">Edit profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
        
            <main class="py-4">

                <div class="container">
                    <div class="row justify-content-center">
                        @if (Auth::check())
                            <div id="A">
                                <!-- side nav -->
                                <div id="toggleable">
                                    @include('layouts.sidebar')
                                </div>
                            </div>
                        @endif
                        
                            @yield('content')
                        
                        
                    </div>
                </div>
            </main>
        
        
       
    </div>
    
</body>
</html>
