@extends('layouts.app')
@section('content')

    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{session('message')}}
            </div>
        @endif
        <div class="col-md-10 col-md-offset-1">
            <h3>List of clients</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name
                        @if(Auth::user()->can(["manage-clients","add-clients"]))
                            <a href="{{route('clients.create')}}" class="pull-right">Add client <span
                                        class="glyphicon glyphicon-plus-sign"></span>

                            </a>
                        @endif
                    </th>
                    <th>Organization</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($clients) && count($clients))
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->organization}}
                            </td>
                            <td>
                                @if(Auth::user()->can(["manage-clients","edit-clients"]))
                                    <a class="btn btn-default" href="{{route('clients.edit',$client->id)}}">Edit</a>
                                @endif
                                @if(Auth::user()->can(["manage-clients","delete-clients"]))
                                    {!! Form::open(['route' => ['clients.destroy', $client->id],'method'=>'post','id'=>'delete-client','style'=>'display:inline-block']) !!}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger">Delete</button>
                                    {!! Form::close() !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No client yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection