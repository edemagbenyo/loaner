@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="{{(Request::segment(2) == '' || Request::segment(2) == 'index') ? 'active': ''}}"><a>@lang('menu.dpts.sta') </a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'rooms' ) ? 'active': ''}}"><a href="{{route('rooms.index')}}">Clients</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'bar' ) ? 'bar': ''}}"><a href="{{route('users.create')}}">Payment Status</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'bar' ) ? 'restaurant': ''}}"><a href="{{route('users.create')}}">Land/Building Status</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'bar' ) ? 'sports': ''}}"><a href="{{route('users.create')}}">Track Client</a></li>
    </ul>
    <div class="">
        @yield('departments-content')
    </div>
@endsection