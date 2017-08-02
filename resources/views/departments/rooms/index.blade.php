@extends('departments/index')
@section('departments-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Clients<span class="pull-right"><a href="{{route('rooms.view.prices')}}">Payment Status</a></span></h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>@lang('menu.name') <span class="pull-right"><a href="{{route('rooms.create')}}">Add client <span class="glyphicon glyphicon-plus-sign"></span></a></span></th>
                </tr>
                </thead>
                <tbody>
                @if(count($rooms))
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{$room->name}}
                                <div class="btn-group pull-right" role="group" aria-label="...">
                                    <a class="btn btn-default" href="{{route('rooms.edit',$room->id)}}">@lang('menu.edit')</a>
                                    <a class="btn btn-default" href="{{route('room.set.price',$room->id)}}">Set Price</a>
                                    <a class="btn btn-danger">@lang('menu.delete')</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3"> No client created.</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$rooms->links()}}
        </div>
    </div>
@endsection