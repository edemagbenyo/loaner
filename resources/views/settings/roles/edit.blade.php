@extends('settings/index')
@section('settings-content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Create a new role</h3>
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach( $errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($role, ['route' => ['roles.update', $role->id],'method'=>'PUT']) !!}
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                           value="{{old('name',$role->name)}}">
                </div>
                <div class="form-group">
                    <label for="display">Display Name</label>
                    <input type="text" name="display_name" class="form-control" id="display"
                           placeholder="Display name" value="{{old('display_name',$role->display_name)}}">
                </div>
                <div class="form-group">
                    <label for="display">Description</label>
                    <textarea name="description" id="" cols="30" rows="2"
                              class="form-control">{{old('description',$role->description)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="display">Permissions</label>
                    @if(count($permissions))
                        <select name="permissions[]" id="permissions" class="form-control" multiple="multiple">
                            @foreach($permissions as $perm)
                                <option value="{{$perm->id}}" title="{{$perm->description}}" {{(isset($perm->selected) && $perm->selected)?'selected':''}}>{{$perm->display_name}}</option>
                            @endforeach
                        </select>
                    @else
                        No Permissions available
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>

@endsection

