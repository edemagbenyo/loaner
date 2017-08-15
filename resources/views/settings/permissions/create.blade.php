@extends('settings/index')
@section('settings-content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Create a new Permission</h3>
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach( $errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('permissions.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="display">Display Name</label>
                    <input type="text" name="display_name" class="form-control" id="display"
                           placeholder="Display name" value="{{old('display_name')}}">
                </div>
                <div class="form-group">
                    <label for="display">Description</label>
                    <textarea name="description" id="" cols="30" rows="2" class="form-control">{{old('description')}}</textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection