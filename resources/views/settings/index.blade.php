                                                                                                                                                                                                                                                                                                                                                                                                                                                                  @extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="{{(Request::segment(2) == 'index') ? 'active': ''}}"><a href="{{route('settings.index')}}">General</a></li>
        <li role="presentation" class="{{(Request::segment(2) == 'roles-permissions' || Request::segment(2) == 'roles' || Request::segment(2) == 'permissions') ? 'active': ''}}"><a href="{{route('roles.perms')}}">Roles/Permissions</a></li>

    </ul>
    <div class="">
        @yield('settings-content')
    </div>
@endsection