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
        <div class="col-md-12">
            @if(Auth::user()->can(["create-schedules","manage-calls"]))
                <a href="" class="btn btn-success" data-toggle="modal" data-target="#makeCall">Create a schedule</a>
            @endif
             @if(Auth::user()->can(["manage-users"]))
             <a class="btn btn-info" href="{{route('userscalls')}}">Users Call track</a>
             @endif
            <h3>{{$userTrack->name. ' calls tracking'}}</h3>
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Enquiry</th>
                    <th>Action</th>
                    <th>Customer</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($calls) && count($calls))
                    @foreach($calls as $call)
                        <tr>
                            <td>{{$call->enquiry}}</td>
                            <td>{{$call->action}}</td>
                            <td>{{$call->customer->name or "N/A"}}</td>
                            <td>{{$call->call_date_time}}</td>
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
@section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
@endsection