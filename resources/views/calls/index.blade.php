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
            <a href="" class="btn btn-success" data-toggle="modal" data-target="#makeCall">Make Call</a>
            <h3>Today's calls</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Enquiry</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($calls) && count($calls))
                    @foreach($calls as $call)
                        <tr>
                            <td>{{$call->enquiry}}</td>
                            <td>{{$call->action}}
                            </td>
                            <td></td>
                            <td>

                                    <a class="btn btn-default" href="{{route('calls.edit',$call->id)}}">Edit</a>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No call yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    @include('calls.call')
@endsection