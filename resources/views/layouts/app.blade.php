<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'G.E.C.') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--Select 2 --}}
    <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    @section('styles')
    @show

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
                <a class="navbar-brand" href="{{ url('home') }}">
                    {{ config('app.name', 'G.E.C. Union') }}
                    <img src="{{asset('img/logo.jpg')}}" alt="" width=50 style="display:inline;">
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
                                    <a href="{{ route('changepassword') }}">
                                        Change password
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
                            @if(Auth::user()->can(["*accounts","make-sales","cash","view-accounts-clients","view-accounts-suppliers","view-accounts-loans"]))
                                <li role="presentation" class="{{Request::segment(1) == 'accounts' ? 'active': ''}}"><a
                                            href="{{route('accounts.index')}}">@lang('menu.acc')</a></li>
                            @endif
                            @if(Auth::user()->can("*clients"))
                                <li role="presentation" class="{{Request::segment(1) == 'clients' ? 'active': ''}}"><a
                                            href="{{route('clients.index')}}">Members</a></li>
                            @endif
                            @if(Auth::user()->can("*loans"))
                                <li role="presentation" class="{{Request::segment(1) == 'loans' ? 'active': ''}}"><a
                                            href="{{route('loans.index')}}">Loans</a></li>
                            @endif
                            @if(Auth::user()->can("*lands"))
                                <li role="presentation" class="{{(Request::segment(1) == 'calls'|| Request::segment(1) == 'users-calls' || Request::segment(1) == 'user-calls') ? 'active': ''}}"><a
                                            href="#">Call Center</a></li>
                            @endif
                           

                            @if(Auth::user()->can("*users"))
                                <li role="presentation" class="{{Request::segment(1) == 'users' ? 'active': ''}}"><a
                                            href="{{route('users.index')}}">@lang('menu.use') </a></li>
                            @endif
                            @if(Auth::user()->can("*settings"))
                                <li role="presentation" class="{{Request::segment(1) == 'settings' ? 'active': ''}}"><a
                                            href="{{route('settings.index')}}">@lang('menu.set') </a></li>
                            @endif
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
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
@section('scripts')
@show
<script type="text/javascript">
    $(document).ready(function () {
        $("select#permissions").select2();

        $("select#members").select2();
        $("select.guar").select2();

        $('span.select2').width('auto');
        $('span.select2').css('display', 'block');
        $('#datepicker').datetimepicker({
            format: "YYYY-MM-DD"
        });
        $('.guarantor').datetimepicker({
            format: "YYYY-MM-DD"
        });
        $('#clientTransact').DataTable();
        $('#queryCash').DataTable();
        $('.datatable').DataTable();


        var btn_rst = $('.reset-btn');
        var frm_rst = $('#reset-form');
        var user_id = $('#user_id');
        btn_rst.on('click',function(){
            $this = $(this);
            
            user_id.val($this.data('user-id'))
            frm_rst.submit();
        });
    });
</script>
</body>
</html>
