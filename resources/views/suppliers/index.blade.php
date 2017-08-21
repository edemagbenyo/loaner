@extends('layouts.app')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection
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
            <h3>List of suppliers</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name
                        @if(Auth::user()->can(["manage-suppliers","add-suppliers"]))
                            <a href="{{route('suppliers.create')}}" class="pull-right">Add supplier <span
                                        class="glyphicon glyphicon-plus-sign"></span>

                            </a>
                        @endif
                    </th>
                    <th>Organization</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($suppliers) && count($suppliers))
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->organization}}
                            </td>
                            <td>
                                @if(Auth::user()->can(["manage-suppliers","edit-suppliers"]))
                                    <a class="btn btn-default" href="{{route('suppliers.edit',$supplier->id)}}">Edit</a>
                                @endif
                                @if(Auth::user()->can(["manage-suppliers","delete-suppliers"]))
                                    {!! Form::open(['route' => ['suppliers.destroy', $supplier->id],'method'=>'post','id'=>'delete-supplier','style'=>'display:inline-block']) !!}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger">Delete</button>
                                    {!! Form::close() !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No supplier yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection