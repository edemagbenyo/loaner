@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        @if(Auth::user()->can(["manage-accounts","make-sales"]))
            <li role="presentation"
                class="{{(Request::segment(2) == '' || Request::segment(2) == 'index' ||  Request::segment(3) == 'sales') ? 'active': ''}}">
                <a href="{{route('accounts.index')}}">Sales</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-clients"]))
            <li role="presentation" class="{{(Request::segment(2) == 'clients' ) ? 'active': ''}}"><a
                        href="#">Members Accounts</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-suppliers"]))
            <li role="presentation" class="{{(Request::segment(2) == 'suppliers' ) ? 'active': ''}}"><a
                        href="#">Transactions</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-lands"]))
            <li role="presentation" class="{{(Request::segment(2) == 'lands' ) ? 'active': ''}}"><a
                        href="#">Loans Status</a></li>
        @endif
    </ul>
    <div class="">
        @yield('account-content')
    </div>
@endsection