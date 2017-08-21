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
            <h3>List of lands</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name
                        @if(Auth::user()->can(["manage-lands","add-lands"]))
                            <a href="{{route('lands.create')}}" class="pull-right">Add land <span
                                        class="glyphicon glyphicon-plus-sign"></span>

                            </a>
                        @endif
                    </th>
                    <th>Location</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($lands) && count($lands))
                    @foreach($lands as $land)
                        <tr>
                            <td>{{$land->name}}</td>
                            <td>{{$land->location}}
                            </td>
                            <td>
                                @if(Auth::user()->can(["manage-lands","edit-lands"]))
                                    <a class="btn btn-default" href="{{route('lands.edit',$land->id)}}">Edit</a>
                                @endif
                                @if(Auth::user()->can(["manage-lands","delete-lands"]))
                                    {!! Form::open(['route' => ['lands.destroy', $land->id],'method'=>'post','id'=>'delete-land','style'=>'display:inline-block']) !!}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger">Delete</button>
                                    {!! Form::close() !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No land yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection