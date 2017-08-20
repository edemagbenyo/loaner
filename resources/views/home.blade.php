@extends('layouts.app')

@section('content')
    <h1>Welcome to L-Host Management System.</h1>
    <div class="row">
        @if(Auth::user()->can("*calls"))
            <div class="col-md-3">
                <a class="btn btn-lg btn-info">Call Center</a>
            </div>
        @endif
        @if(Auth::user()->can("*accounts"))
            <div class="col-md-3">
                <a class="btn btn-lg btn-success">Accounting</a>
            </div>
        @endif
        @if(Auth::user()->can("*clients"))
            <div class="col-md-3">
                <a class="btn btn-lg btn-warning">Clients</a>
            </div>
        @endif
        @if(Auth::user()->can("*lands"))
            <div class="col-md-3">
                <a class="btn btn-lg btn-danger">Lands</a>
            </div>
        @endif
    </div>
@endsection
