@extends('settings/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection
@section('settings-content')

    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{session('message')}}
            </div>
        @endif
        <hr>
        <div class="col-md-6">
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Roles <a href="{{route('roles.create')}}" class="pull-right">Add Role <span
                                    class="glyphicon glyphicon-plus-sign"></span>
                        </a></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($roles) && count($roles))
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->display_name}}
                                <div class="btn-group pull-right" role="group" aria-label="...">
                                    <a class="btn btn-default" href="{{route('roles.edit',$role->id)}}">Edit</a>
                                    <a class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>There is no current roles.</td>
                    </tr>
                @endif
                </tbody>
            </table>
{{--            {{ $roles->links() }}--}}
        </div>
        <div class="col-md-6">
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Permissions
                        @if(Auth::user()->can("create-permissions"))
                        <a href="{{route('permissions.create')}}" class="pull-right">Add Permission <span
                                    class="glyphicon glyphicon-plus-sign"></span> </a>
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(isset($permissions) && count($permissions))
                    @foreach($permissions as $perm)
                        <tr>
                            <td title="{{$perm->description}}">{{$perm->display_name}}
                                @if(Auth::user()->can("create-permissions"))
                                <div class="btn-group pull-right" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default">Edit</button>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </div>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>There is no current permissions.</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{--{{ $permissions->links() }}--}}
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
@endsection
