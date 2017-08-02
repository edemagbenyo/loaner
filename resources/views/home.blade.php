@extends('layouts.app')

@section('content')
    <h1>Welcome to L-Host Management System.</h1>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-lg btn-info">POS</a>
        </div>

        <div class="col-md-3">
            <a class="btn btn-lg btn-success">Accounting</a>
        </div>

        <div class="col-md-3">
            <a class="btn btn-lg btn-warning">Clients</a>
        </div>

        <div class="col-md-3">
            <a class="btn btn-lg btn-danger">Lands</a>
        </div>
    </div>
@endsection
