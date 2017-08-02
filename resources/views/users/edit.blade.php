@extends('users/index')
@section('users-content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center;">Editing <b>{{$user->name}}</b> Information</h3>
            {!! Form::model($user, ['route' => ['users.update', $user->id],'method'=>'PUT']) !!}
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Name</label>

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}"
                       required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}"
                       required>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="role" class="user-role">User role</label>
                @if(count($roles))
                    <select name="role" id="" class="form-control">
                        <option value="">Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{(count($user->roles) && $role->id == $user->roles[0]->id ? 'selected':'')}}>{{$role->display_name}}</option>
                        @endforeach
                    </select>
                @else
                @endif
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection