@extends('departments/index')
@section('departments-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>List of rooms prices</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name <span class="pull-right"></th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(count($prices))
                    @foreach($prices as $price)
                        <tr>
                            <td>{{$price->room->name}}</td>
                            <td>{{$price->price}}</td>
                            <td>{{$price->room_type}}</td>
                            <td>{{$price->category}}</td>
                            <td>
                                    <a class="btn btn-default" href="{{route('rooms.edit.price',$price->id)}}">Edit</a>
                                    <a class="" style="display: inline-block;">
                                        <form action="{{route('room.delete.price',[$price->id])}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="price" value="{{$price->id}}">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3"> No room created.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection