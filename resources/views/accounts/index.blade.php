@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="{{(Request::segment(2) == '' || Request::segment(2) == 'index') ? 'active': ''}}"><a href="{{route('accounts.index')}}">Sales</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'cashbook' ) ? 'active': ''}}"><a href="{{route('accounts.cashbook')}}">Cash Book</a></li>
            <li role="presentation" class="{{(Request::segment(2) == 'clients' ) ? 'active': ''}}"><a href="{{route('accounts.clients')}}">Clients</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'bar' ) ? 'bar': ''}}"><a href="{{route('users.create')}}">Suppliers</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'bar' ) ? 'restaurant': ''}}"><a href="{{route('users.create')}}">Land Status</a></li>
    </ul>
    <div class="">
        @yield('account-content')
    </div>
@endsection