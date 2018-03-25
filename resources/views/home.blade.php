@extends('layouts.app')

@section('content')
    <h1 style="text-align:center">Welcome to Global Evangelical Church <br> Empowerment Union.</h1>
    <div class="row">
        @if(Auth::user()->can("*accounts"))
            <div class="col-md-3 btn btn-info">
                Total number of members
                <br>
                {{$members_count}}
            </div>
        @endif
        @if(Auth::user()->can("*accounts"))
            <div class="col-md-3 btn btn-success">
                Total amount of withdrawal today
                <br>
                Ghc: 0.00
            </div>
        @endif
        @if(Auth::user()->can("*accounts"))
            <div class="col-md-3  btn btn-danger">
                Total amount of deposit today
                <br>
                Ghc: 0.00
            </div>
        @endif
        @if(Auth::user()->can("*accounts"))
            <div class="col-md-3  btn btn-warning">
                Total amount of loan paid today
                <br>
                Ghc: 0.00
            </div>
        @endif
    </div>
@endsection
