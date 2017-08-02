<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--Select 2 --}}
    <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet" />
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <ul class="nav nav-pills" role="tablist">
                                <li role="presentation" class="{{Request::segment(1) == 'home' ? 'active': ''}}"><a href="{{url('home')}}">@lang('menu.das') </a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'POS' ? 'active': ''}}"><a href="#">@lang('menu.pos') </a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'departments' ? 'active': ''}}"><a href="{{route('departments.index')}}">@lang('menu.acc')</a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'accounts' ? 'active': ''}}"><a href="#">Lands</a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'accounts' ? 'active': ''}}"><a href="#">Real Estate</a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'users' ? 'active': ''}}"><a href="{{route('users.index')}}">@lang('menu.use') </a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'settings' ? 'active': ''}}"><a href="{{route('settings.index')}}">@lang('menu.set') </a></li>
                                <li role="presentation" class="{{Request::segment(1) == 'settings' ? '': ''}}"><a href="{{route('settings.index')}}">Employees</a></li>
                            </ul>
                        </div>

                        <div class="panel-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("select#permissions").select2();
        });
    </script>
</body>
</html>