@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center;">Editing {{$supplier->name}} <a href="{{route('suppliers.index')}}" class="pull-right">List
                    suppliers <span
                            class="glyphicon glyphicon-plus-sign"></span>
                </a></h3>

            {!! Form::open(['route' => ['suppliers.update', $supplier->id],'method'=>'put']) !!}
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$supplier->name) }}" required
                           autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
                    <label for="organization" class="control-label">Organization</label>

                    <input id="organization" type="text" class="form-control" name="organization"
                           value="{{ old('organization',$supplier->organization) }}" required>

                    @if ($errors->has('organization'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                    <label for="contact" class="control-label">Contact</label>

                    <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact',$supplier->contact) }}"
                           required>

                    @if ($errors->has('contact'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>

                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email',$supplier->email) }}" >

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="control-label">Address</label>

                    <input id="address" type="address" class="form-control" name="address" value="{{ old('address',$supplier->address) }}"
                           required>

                    @if ($errors->has('address'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="control-label">Location</label>

                    <input id="location" type="location" class="form-control" name="location" value="{{ old('location',$supplier->location) }}"
                           required>

                    @if ($errors->has('location'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('residence') ? ' has-error' : '' }}">
                    <label for="residence" class="control-label">Residence</label>

                    <input id="residence" type="residence" class="form-control" name="residence"
                           value="{{ old('residence',$supplier->residence) }}"
                            >

                    @if ($errors->has('residence'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('residence') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('house') ? ' has-error' : '' }}">
                    <label for="house" class="control-label">House Number</label>

                    <input id="house" type="house" class="form-control" name="house" value="{{ old('house',$supplier->house) }}"
                            >

                    @if ($errors->has('house'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                    @endif
                </div>


                <div class="form-group">
                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection