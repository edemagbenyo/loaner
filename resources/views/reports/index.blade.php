@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        @if(Auth::user()->can("*reports"))
            <li role="presentation"
                class="{{(Request::segment(2) == '' || Request::segment(2) == 'index' ||  Request::segment(2) == 'loan') ? 'active': ''}}">
                <a href="{{route('reports.index')}}">Loans</a></li>
        @endif
        @if(Auth::user()->can("*reports"))
            <li role="presentation"
                class="{{(Request::segment(2) == '' || Request::segment(2) == 'account' ) ? 'active': ''}}">
                <a href="{{route('reports.account')}}">Accounts</a></li>
        @endif
        @if(Auth::user()->can("*reports"))
            <li role="presentation" class="{{(Request::segment(2) == 'interest' ) ? 'active': ''}}"><a
                        href="{{route('reports.interest')}}">Loans Interest</a></li>
        @endif
        @if(Auth::user()->can("*reports"))
            <li role="presentation" class="{{(Request::segment(2) == 'registration' ) ? 'active': ''}}"><a
                        href="{{route('reports.registration')}}">Registrations</a></li>
        @endif
    </ul>
    <div class="">
        @yield('reports-content')
    </div>
@endsection