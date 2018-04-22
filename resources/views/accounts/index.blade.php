@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        @if(Auth::user()->can(["manage-accounts","make-sales"]))
            <li role="presentation"
                class="{{(Request::segment(2) == '' || Request::segment(2) == 'index' ||  Request::segment(3) == 'sales') ? 'active': ''}}">
                <a href="{{route('accounts.index')}}">Transactions</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-clients"]))
            <li role="presentation" class="{{(Request::segment(2) == 'clients' ) ? 'active': ''}}"><a
                        href="{{route('accounts.clients')}}">Members Accounts</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-suppliers"]))
            <li role="presentation" class="{{(Request::segment(2) == 'transacts' ) ? 'active': ''}}"><a
                        href="{{route('accounts.get.transact')}}">Transactions List</a></li>
        @endif
        @if(Auth::user()->can(["manage-accounts","view-accounts-loans"]))
            <li role="presentation" class="{{(Request::segment(2) == 'loans' ) ? 'active': ''}}"><a
                        href="{{route('accounts.loans')}}">Loans Status</a></li>
        @endif
    </ul>
    <div class="">
        @yield('account-content')
    </div>
@endsection