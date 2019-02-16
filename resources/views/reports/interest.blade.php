@extends('reports.index')
@section('reports-content')
    
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center; text-decoration:underline">
            
             Loan Interest Report  </h3>
            <div class="alert alert-danger" style="display:none">
                <p id="error"></p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('reports.interest')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                            
                <div class="form-group">
                    <label for="">Date Period </label>
                    <div class="row">
                        <div class="col-md-6">
                            <input id="height" type="text" class="form-control guarantor" name="start_date"
                                   placeholder="Start Date" value="" required>
                        </div>
                        <div class="col-md-6">
                            <input id="height" type="text" class="form-control guarantor" name="end_date"
                                   placeholder="Date" required>
                        </div>
                    </div>
                </div>

                
                <div class="form-group">
                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary">
                            Get Report
                        </button>
                    </div>
                </div>
                @if(isset($reports))
                    
                    <div class="form-group">
                        <div style="margin-top: 10px;">
                        <h4>Total Interest on Loan Approved for the period <b>{{$period['start_date']}}</b> and <b>{{$period['end_date']}} </b> stands at <br>
                            <b style="color:red; display: inline; text-align:'center'">Ghc{{$reports}}</b>
                        </h4>
                            
                        </div>
                    </div>
                @else
                <div><h4 style="color:red">Select the period for which you want to see the report</h4></div>
                @endif
            </form>
        </div>
    </div>
@endsection