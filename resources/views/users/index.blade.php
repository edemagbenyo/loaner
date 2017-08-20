@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">

        <li role="presentation" class="{{(Request::segment(2) == '' || Request::segment(2) == 'list') ? 'active': ''}}">
            <a href="{{route('users.index')}}">List</a></li>
        @if(Auth::user()->can(["manage-users","create-users"]))
            <li role="presentation"
                class="{{(Request::segment(2) == 'create' ||Request::segment(3) == 'edit' ) ? 'active': ''}}"><a
                        href="{{route('users.create')}}">Create user</a></li>
        @endif
    </ul>
    <div class="">
        @yield('users-content')
    </div>
@endsection