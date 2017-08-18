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
                <a href="" class="btn btn-success">Today's sales</a>
                <a href="" class="btn btn-info">Weekly sales</a>
            </h5>
            <h3 style="text-align: center">Land Sales</h3>
            <form action="{{route('accounts.post.sales')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Land title</label>
                            <input type="text" name="details" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Client Name</label>
                            <select name="client_id" id="clients" class="form-control" required>
                                <option value="">Select a client</option>
                                @foreach($clients as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Price</label>
                            <input type="text" id="price" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="name">Currency</label>
                            <select name="currency" class="form-control">
                                <option value="g">Ghana Cedi</option>
                                <option value="u">US Dollar</option>
                                <option value="e">Euro</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       <div class="col-md-6">
                           <label for="name">Land</label>
                           <select name="land_id" id="clients" class="form-control">
                               <option value="">Select a land</option>
                               @foreach($lands as $l)
                                   <option value="{{$l->id}}">{{$l->name}}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="col-md-6">
                           <label for="">Payment</label>
                           <input type="text" id="payment" name="payment" class="form-control" required>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       <div class="col-md-6">
                           {{--<label for="name">Land</label>--}}
                           {{--<div class="progress">--}}
                               {{--<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">--}}
                                   {{--2000 sqft--}}
                               {{--</div>--}}
                           {{--</div>--}}
                       </div>
                       <div class="col-md-6">
                           <label for="">Balance</label>
                           <input type="text" id="balance" name="balance" class="form-control" readonly>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="name">Measure</label>
                            <select name="measure" id="measure" class="form-control measure" required>
                                <option value="sqt">Foot</option>
                                <option value="sqm">Metre</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="name">Width</label>
                            <input type="text" id="width" class="form-control width" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Breadth</label>
                            <input type="text" id="height" class="form-control height" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Dimension(Square)</label>
                            <input type="text" name="dimension" id="size" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <button type="submit" class="btn btn-warning">Make Sales</button>
            </form>
        </div>
    </div>
@endsection
