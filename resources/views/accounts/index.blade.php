@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        @if(Auth::user()->can(["manage-accounts","make-sales"]))
            <li role="presentation"
                class="{{(Request::segment(2) == '' || Request::segment(2) == 'index' ||  Request::segment(3) == 'sales') ? 'active': ''}}">
                <a href="{{route('accounts.index')}}">Sales</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","cash"]))
            <li role="presentation"
                class="{{(Request::segment(2) == 'cashbook' || Request::segment(3) == 'cashbook') ? 'active': ''}}"><a
                        href="{{route('accounts.cashbook')}}">Cash Book</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-clients"]))
            <li role="presentation" class="{{(Request::segment(2) == 'clients' ) ? 'active': ''}}"><a
                        href="{{route('accounts.clients')}}">Clients</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-suppliers"]))
            <li role="presentation" class="{{(Request::segment(2) == 'suppliers' ) ? 'active': ''}}"><a
                        href="{{route('accounts.suppliers')}}">Suppliers</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-lands"]))
            <li role="presentation" class="{{(Request::segment(2) == 'lands' ) ? 'active': ''}}"><a
                        href="{{route('accounts.lands')}}">Land Status</a></li>
        @endif
    </ul>
    <div class="">
        @yield('account-content')
    </div>
@endsection