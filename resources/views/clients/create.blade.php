@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center; text-weight:bold;">New member registration <a href="{{route('clients.index')}}" class="pull-right">List
                    members
                </a></h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    Check your form. There are some errors to fix.
                </div>
            @endif

            <form action="{{route('clients.store')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Title*</label>
                    <select name="title" id="title" class="form-control">
                        <option value="">Select title</option>
                        <option value="Dr" {{(old('title') == 'Dr' ? 'selected': '')}}>Dr.</option>
                        <option value="Mr"  {{(old('title') == 'Mr' ? 'selected': '')}}>Mr.</option>
                        <option value="Mrs"  {{(old('title') == 'Mrs' ? 'selected': '')}}>Mrs.</option>
                        <option value="Ms"  {{(old('title') == 'Ms' ? 'selected': '')}}>Ms.</option>
                    </select>
                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div></div>
                </div>
                <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                    <label for="lname" class="control-label">Surname*</label>
                    <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required
                           autofocus>

                    @if ($errors->has('lname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                        <div class="col-md-6">
                            <label for="fname" class="control-label">First name*</label>
                            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required>

                            @if ($errors->has('fname'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="title" class="control-label">Other names*</label>
                            <input id="oname" type="text" class="form-control" name="oname" value="{{ old('oname') }}" required>

                            @if ($errors->has('oname'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('oname') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 {{ $errors->has('telephone1') ? ' has-error' : '' }}" >
                            <label for="telephone1" class="control-label">Telephone Number*</label>
                            <input id="telephone1" type="text" class="form-control" name="telephone1" value="{{ old('telephone1') }}" required>

                            @if ($errors->has('telephone1'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('telephone1') }}</strong>
                                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 {{ $errors->has('telephone2') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Alternative Telephone Number</label>
                            <input id="telephone2" type="text" class="form-control" name="telephone2" value="{{ old('telephone2') }}" required>

                            @if ($errors->has('telephone2'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('telephone2') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('paddress') ? ' has-error' : '' }}">
                    <label for="paddress" class="control-label">Postal Address*</label>

                    <input id="paddress" type="text" class="form-control" name="paddress"
                           value="{{ old('paddress') }}" required>

                    @if ($errors->has('paddress'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('paddress') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('raddress') ? ' has-error' : '' }}">
                    <label for="raddress" class="control-label">Residential Address</label>

                    <input id="raddress" type="text" class="form-control" name="raddress"
                           value="{{ old('raddress') }}" required>

                    @if ($errors->has('raddress'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('raddress') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 {{ $errors->has('pob') ? ' has-error' : '' }}">
                            <label for="pob" class="control-label">Place of Birth</label>
                            <input id="pob" type="text" class="form-control" name="pob" value="{{ old('pob') }}" required>

                            @if ($errors->has('pob'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('pob') }}</strong>
                                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 {{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Date of Birth</label>
                            <input id="datepicker" type="text" class="form-control" name="dob" value="{{ old('dob') }}" required>

                            @if ($errors->has('dob'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 {{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="control-label">Sex</label>
                            <select name="sex" id="sex" class="form-control">
                                <option value="m" {{(old('sex') == 'm' ? 'selected': '')}}>Male</option>
                                <option value="f" {{(old('sex') == 'f' ? 'selected': '')}} >Female</option>
                                <option value="o" {{(old('sex') == 'o' ? 'selected': '')}}>N/A</option>
                            </select>
                            @if ($errors->has('sex'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('sex') }}</strong>
                                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 {{ $errors->has('marital') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Marital Status</label>
                            <select name="marital" id="marital" class="form-control">
                                <option value="s"  {{(old('marital') == 's' ? 'selected': '')}} >Single</option>
                                <option value="m"  {{(old('marital') == 'm' ? 'selected': '')}}>Married</option>
                                <option value="d" {{(old('marital') == 'd' ? 'selected': '')}}>Divorced</option>
                                <option value="w" {{(old('marital') == 'w' ? 'selected': '')}}>Widow</option>
                                <option value="o" {{(old('marital') == 'o' ? 'selected': '')}}>N/A</option>
                            </select>
                            @if ($errors->has('marital'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('marital') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('profession') ? ' has-error' : '' }}">
                    <label for="profession" class="control-label">Profession/Occupation*</label>

                    <input id="profession" type="text" class="form-control" name="profession" value="{{ old('profession') }}"
                           required>

                    @if ($errors->has('profession'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                    @endif
                </div>

                <hr>
                <h3>Spouse information</h3>
                <div class="form-group{{ $errors->has('spousename') ? ' has-error' : '' }}">
                    <label for="spousename" class="control-label">Spouse name</label>

                    <input id="spousename" type="text" class="form-control" name="spousename" value="{{ old('spousename') }}" >

                    @if ($errors->has('spousename'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('spousename') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('spousetel') ? ' has-error' : '' }}">
                    <label for="spousetel" class="control-label">Spouse telephone number</label>

                    <input id="spousetel" type="text" class="form-control" name="spousetel" value="{{ old('spousetel') }}" >

                    @if ($errors->has('spousetel'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('spousetel') }}</strong>
                                    </span>
                    @endif
                </div>
                <hr>
                <h3>Next of kin Information</h3>
                <div class="form-group{{ $errors->has('next_name') ? ' has-error' : '' }}">
                    <label for="next_name" class="control-label">Name</label>

                    <input id="next_name" type="text" class="form-control" name="next_name" value="{{ old('next_name') }}" >

                    @if ($errors->has('next_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('next_name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('next_tel1') ? ' has-error' : '' }}">
                    <label for="next_tel1" class="control-label">Telephone number</label>

                    <input id="next_tel1" type="text" class="form-control" name="next_tel1" value="{{ old('next_tel1') }}" >

                    @if ($errors->has('next_tel1'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('next_tel1') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('next_address') ? ' has-error' : '' }}">
                    <label for="next_address" class="control-label">Address</label>

                    <input id="next_address" type="text" class="form-control" name="next_address" value="{{ old('next_address') }}" >

                    @if ($errors->has('next_address'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('next_address') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('relationship') ? ' has-error' : '' }}">
                    <label for="relationship" class="control-label">Relationship</label>

                    <input id="relationship" type="text" class="form-control" name="relationship" value="{{ old('relationship') }}" >

                    @if ($errors->has('relationship'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('relationship') }}</strong>
                                    </span>
                    @endif
                </div>

                


                <div class="form-group">
                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection