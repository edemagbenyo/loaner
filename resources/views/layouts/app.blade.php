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
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--Select 2 --}}
    <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet"/>
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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
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
                            <li role="presentation" class="{{Request::segment(1) == 'home' ? 'active': ''}}"><a
                                        href="{{url('home')}}">@lang('menu.das') </a></li>
                            <li role="presentation" class="{{Request::segment(1) == 'accounts' ? 'active': ''}}"><a
                                        href="{{route('accounts.index')}}">@lang('menu.acc')</a></li>
                            @if(Auth::user()->can("*clients"))
                                <li role="presentation" class="{{Request::segment(1) == 'clients' ? 'active': ''}}"><a
                                            href="{{route('clients.index')}}">Clients</a></li>
                            @endif
                            <li role="presentation" class="{{Request::segment(1) == 'lands' ? 'active': ''}}"><a
                                        href="{{route('lands.index')}}">Lands</a></li>
                            <li role="presentation" class="{{Request::segment(1) == 'calls' ? 'active': ''}}"><a
                                        href="{{route('calls.index')}}">Call Center</a></li>
                            <li role="presentation" class="{{Request::segment(1) == 'suppliers' ? 'active': ''}}"><a
                                        href="{{route('suppliers.index')}}">Suppliers</a></li>
                            @if(Auth::user()->can("*users"))
                                <li role="presentation" class="{{Request::segment(1) == 'users' ? 'active': ''}}"><a
                                            href="{{route('users.index')}}">@lang('menu.use') </a></li>
                            @endif
                            <li role="presentation" class="{{Request::segment(1) == 'settings' ? 'active': ''}}"><a
                                        href="{{route('settings.index')}}">@lang('menu.set') </a></li>
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
{{--<script src="{{ asset('js/manifest.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("select#permissions").select2();

        $("select#clients").select2();
        $('span.select2').width('auto');
        $('span.select2').css('display','block');
        $('#datepicker').datetimepicker({
            format:"YYYY-MM-DD H:mm"
        });



    });
</script>
</body>
</html>
