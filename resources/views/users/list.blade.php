@extends('users/index')
@section('users-content')

    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{session('message')}}
            </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <h3>List of Users</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name <a href="{{route('users.create')}}" class="pull-right">Add User <span
                                    class="glyphicon glyphicon-plus-sign"></span>
                        </a></th>
                    <th>Role</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($users) && count($users))
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}

                            </td>
                            <td>
                                @if(count($user->roles))
                                    {{ $user->roles[0]->display_name }}
                                    @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
                                    <a class="btn btn-default" href="{{route('users.edit',$user->id)}}">Edit</a>
                                    @if($user->id != Auth::user()->id)
                                        <a class="btn btn-danger">Delete</a>
                                    @endif
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
            {{ $users->links() }}
        </div>
    </div>
@endsection