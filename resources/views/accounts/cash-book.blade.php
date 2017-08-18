@extends('accounts/index')
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="background: #c7ddef">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            <h5>
                <a href="" class="btn btn-success">Today's book</a>
                <a href="" class="btn btn-info">Weekly book</a>
                <a href="" class="btn btn-danger">Entire book</a>
            </h5>

            <form action="{{route('accounts.post.cashbook')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Memo</label>
                            <input type="text" name="details" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Type of transaction</label>
                            <select name="type" id="transact" class="form-control" required>
                                <option value="c">Cash In</option>
                                <option value="d">Cash Out</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="name">Currency</label>
                            <select name="currency" id="transact" class="form-control" required>
                                <option value="g">Ghana Cedis</option>
                                <option value="u">US Dollar</option>
                                <option value="e">Euro</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Client Name</label>
                            <select name="client_id" id="clients" class="form-control">
                                <option value="">Select a client</option>
                                @foreach($clients as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Open Balance</label>
                            <input type="text" class="form-control" value="{{($open<0) ? '('.abs($open).')' :$open}}"
                                   readonly>
                            <input type="hidden" id="open" value="{{$open}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Date</label>
                            <input type="text" id="datepicker" class="form-control">

                        </div>
                        <div class="col-md-6">
                            <label for="">Close Balance</label>
                            <input type="text" class="form-control" id="close" readonly>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-warning">Complete Transaction</button>
            </form>
        </div>
    </div>
@endsection
