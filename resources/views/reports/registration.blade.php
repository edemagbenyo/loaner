@extends('reports.index')
@section('reports-content')
    
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center; text-decoration:underline">
            
             Registration Report  </h3>
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

            <form action="{{route('reports.registration')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" id="hidden-data">
                
                            
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
                        <h3>Registration Report for the period {{$period['start_date']}} and {{$period['end_date']}}</h3>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Registration Date</th>
                                        <th>Registered By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td>{{$report->fname}}</td>
                                        <td>{{$report->lname}}</td>
                                        <td>{{$report->created_at}}</td>
                                        <td>{{$report->register->name}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                        No report for this period of time. Select a wider range.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                <div><h4 style="color:red">Select the period for which you want to see the report</h4></div>
                @endif
            </form>
        </div>
    </div>
@endsection