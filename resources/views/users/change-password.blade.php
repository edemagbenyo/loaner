@extends('users/index')
@section('users-content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center;">Update password</h3>
            {!! Form::model($user, ['route' => ['changepassword'],'method'=>'PUT']) !!}
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Old password</label>

                <input id="current_password" type="password" class="form-control" name="current_password"
                       required autofocus>
                       @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">New password</label>

                <input id="password" type="password" class="form-control" name="password">
                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="control-label">Confirm password</label>

                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Update Password
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection