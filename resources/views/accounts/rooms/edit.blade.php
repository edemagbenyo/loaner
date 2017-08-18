@extends('departments/index')
@section('departments-content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit room {{$room->name}}</h3>
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach( $errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::model($room,['route'=>['rooms.update',$room->id],'method'=>'put'])}}
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Room Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                           value="{{old('name',$room->name)}}">
                </div>

                <button type="submit" class="btn btn-default">@lang('menu.update')</button>
            </form>
        </div>
    </div>

@endsection

