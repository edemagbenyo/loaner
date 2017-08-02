@extends('departments/index')
@section('departments-content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Set Price for {{$room->name}}</h3>
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach( $errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('room.post.price')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Room Name</label>
                    <input readonly name="name" class="form-control" id="name" placeholder="Name"
                           value="{{old('name',$room->name)}}">
                </div>
                <div class="form-group">
                    <label for="name">Room Price</label>
                    <input type="number" name="price" class="form-control" id="name" placeholder="Price"
                           value="{{old('price')}}">
                </div>
                <div class="form-group">
                    <label for="name">Room Type</label>
                    <select name="room_type" id="" class="form-control">
                        <option value="">Choose Room type</option>
                        <option value="fan">Standing Fan</option>
                        <option value="ac">Air Condition</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Room Category</label>
                    <select name="category" id="" class="form-control">
                        <option value="">Choose Room category</option>
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="vipj">VIP Junior</option>
                        <option value="vips">VIP Senior</option>
                    </select>
                </div>
                <input type="hidden" name="room_id" value="{{$room->id}}">
                <input type="hidden" name="type" value="standard">

                <button type="submit" class="btn btn-default">Save</button>
            </form>
        </div>
    </div>

@endsection

