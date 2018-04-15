@extends('layouts.app')
@section('content')
<style>
    table.custom tr td:nth-child(2n+0){
        font-weight:bold;
    }
</style>
    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{session('message')}}
            </div>
        @endif
        <div class="col-md-10 col-md-offset-1">
            <h3>Loan Details -  <a href="{{route('loans.index')}}">List of loans</a></h3>
            <table class="table custom">
                <tr>
                    <td>Name of applicant:</td>
                    <td>{{$loan->applicant->fname.' '.$loan->applicant->lname  }}</td>
                    <td>Amount applied for:</td>
                    <td>{{$loan->application->amount}}</td>
                </tr>
                <tr>
                    <td> Date applied</td>
                    <td >{{$loan->applicant->created_at}}</td>
                    <td>Loan Status</td>
                    <td>{{$loan->application->status}}</td>
                </tr>
                <tr>
                    <td> Purpose of loan</td>
                    <td colspan="3">{{$loan->application->purpose or "N/A"}}</td>
                    
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td colspan="3"> List of guarantors </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($loan->application) && count($loan->application))
                    @foreach($loan->application->guarantors as $guarantor)
                        <tr>
                            <td>{{$guarantor->applicant->fname }}</td>
                            <td>{{$guarantor->amount}}
                            <td>{{$guarantor->date}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No loan yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection