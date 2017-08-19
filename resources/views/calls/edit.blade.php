@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::open(['route' => ['calls.update', $call->id],'method'=>'put']) !!}
                {{csrf_field()}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="control-label">Client</label>
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$call->name}}" required readonly>
                            <label for="" class="control-label">Contact</label>
                            <input type="text" id="contact" name="contact" class="form-control" value="{{$call->contact}}" required readonly>

                        </div>
                        <div class="col-md-6">
                            <label for="">Date Time</label>
                            <input type="text" id="datepicker"  name=call_date_time"" class="form-control call-date" value="{{old('call_date_time',$call->call_date_time)}}" required>
                            <label for="name" class="control-label">Enquiry</label>
                            <textarea name="enquiry" id="enquiry" cols="30" rows="2" class="form-control">{{old('enquiry',$call->enquiry)}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="control-label">Action</label>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <textarea name="action" id="action" cols="30" rows="3" class="form-control">{{old('action',$call->action)}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">


                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Result</label>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <textarea name="result" id="result" cols="30" rows="2" class="form-control"></textarea>
                </div>

            <input type="submit" class="btn btn-success">
            </form>

        </div>
    </div>
@endsection