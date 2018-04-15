@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection

<style>
    table.custom tr td:nth-child(2n+0){
        font-weight:bold;
    }
</style>
@section('account-content')
    <div class="row">
        @if(session('message'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{session('message')}}
            </div>
        @endif
        <div class="col-md-10 col-md-offset-1">
            <h3>Loan Details -  <a href="{{route('accounts.loans')}}">List of loans</a></h3>
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
                    <td> Account balance</td>
                    <td >{{$loan->account->balance}}</td>
                    <td>Loan balance</td>
                    <td>{{$loan->account->loan_balance or "0"}}</td>
                </tr>
                <tr>
                    <td> Purpose of loan</td>
                    <td colspan="3">{{$loan->application->purpose or "N/A"}}</td>
                    
                </tr>
                <tr>
                    <td>Loan Action</td>
                    <td>
                   
                        @if($loan->application->status =='approved' || $loan->application->status =='denied' )
                        <a href="#" class="btn btn-success" disabled >Approve</a>
                        @else
                        <a href="{{route('accounts.loan.action',['approve',$loan->loanid])}}" class="btn btn-success">Approve</a>
                        @endif
                    </td>
                    <td>
                         @if($loan->application->status =='approved' || $loan->application->status =='denied')
                        <a href="#" class="btn btn-danger" disabled>Deny</a>
                         @else
                        <a href="{{route('accounts.loan.action',['deny',$loan->loanid])}}" class="btn btn-danger">Deny</a>
                        @endif
                    </td>
                    <td>
                         @if($loan->application->status =='approved' || $loan->application->status =='denied' || $loan->application->status =='pending')
                        <a href="#" class="btn btn-warning" disabled>Under Review</a>
                         @else
                        <a href="{{route('accounts.loan.action',['review',$loan->loanid])}}" class="btn btn-warning">Under Review</a>
                        @endif
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td colspan="3"> List of guarantors </td>
                </tr>
                <tr>
                    <th width="40%">Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($loan->application) && count($loan->application))
                    @foreach($loan->application->guarantors as $guarantor)
                        <tr>
                            <td>{{$guarantor->applicant->fname .' '.$guarantor->applicant->fname . ' - ' .$guarantor->applicant->telephone1 }}</td>
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
@section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
@endsection

