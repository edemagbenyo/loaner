@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center;">Create a new land <a href="{{route('lands.index')}}" class="pull-right">List
                    lands <span
                            class="glyphicon glyphicon-plus-sign"></span>
                </a></h3>

            <form action="{{route('lands.store')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Name</label>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                           autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Land size</label>

                    <div class="row">
                        <div class="col-md-4">
                            <select name="measure" id="measure" class="form-control measure" required>
                                <option value="sqt">Foot</option>
                                <option value="sqm">Metre</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input id="width" type="text" class="form-control width" placeholder="width"
                                   required>
                        </div>
                        <div class="col-md-4">
                            <input id="height" type="text" class="form-control height"
                                   placeholder="height" required>
                        </div>
                    </div>

                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="size" class="control-label">Dimension</label>

                    <div class="row">
                        <div class="col-md-6">
                            <input id="size" type="text" name="size" class="form-control"
                                   readonly required>
                            @if ($errors->has('size'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <p><span class="unit"></span></p>
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="price" class="control-label">Price</label>

                            <input id="price" type="text" class="form-control" name="price"
                                   value="{{ old('price') }}" required>

                            @if ($errors->has('price'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="currency">Currency</label>
                            <select name="currency" id="currency" class="form-control">
                                <option value="g">Ghana Cedis</option>
                                <option value="u">US Dollars</option>
                                <option value="e">Euro</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                    <label for="payment" class="control-label">Payment</label>

                    <input id="payment" type="text" class="form-control" name="payment"
                           value="{{ old('payment') }}" required>

                    @if ($errors->has('payment'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('payment') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="control-label">Location</label>

                    <input id="location" type="text" class="form-control" name="location"
                           value="{{ old('location') }}"
                           required>

                    @if ($errors->has('location'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('date_purchased') ? ' has-error' : '' }}">
                    <label for="date_purchased" class="control-label">Date Purchased</label>

                    <input id="datepicker" type="date_purchased" class="form-control" name="date_purchased"
                           value="{{ old('date_purchased') }}"
                            >

                    @if ($errors->has('date_purchased'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('date_purchased') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                    <label for="supplier_id" class="control-label">Supplier</label>

                    <select name="supplier_id" id="" class="form-control">
                        <option value="">Select a supplier</option>
                        @foreach($suppliers as $sup)
                            <option value="{{$sup->id}}">{{$sup->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('supplier_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('supplier_id') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Details</label>

                    <textarea name="description" id="" cols="30" rows="4"
                              class="form-control">{{ old('description') }}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>


                <div class="form-group">
                    <div style="margin-top: 10px;">
                        <button type="submit" class="create btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection