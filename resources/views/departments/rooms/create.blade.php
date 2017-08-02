@extends('departments/index')
@section('departments-content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Create a new client</h3>
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach( $errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('rooms.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Client Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Fullname"
                           value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="name">Client Contact</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Telephone"
                           value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="name">Client Address</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Address"
                           value="{{old('name')}}">
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>

@endsection

