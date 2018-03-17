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
            <h3>List of members</h3>
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th with="50%">Name
                        @if(Auth::user()->can(["manage-clients","add-clients"]))
                            <a href="{{route('clients.create')}}" class="pull-right">Add member <span
                                        class="glyphicon glyphicon-plus-sign"></span>

                            </a>
                        @endif
                    </th>
                    <th width="30%">Account no. </th>
                    <th width="20%">Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($clients) && count($clients))
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->fname . ' '. $client->lname}}</td>
                            <td>{{$client->account->accountno}}
                            </td>
                            <td>
                                @if(Auth::user()->can(["manage-clients","edit-clients"]))
                                    <a class="btn btn-default btn-sm" href="{{route('clients.edit',$client->id)}}">Edit</a>
                                @endif
                                @if(Auth::user()->can(["manage-clients","delete-clients"]))
                                    {!! Form::open(['route' => ['clients.destroy', $client->id],'method'=>'post','id'=>'delete-client','style'=>'display:inline-block']) !!}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                    {!! Form::close() !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No member yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
@endsection