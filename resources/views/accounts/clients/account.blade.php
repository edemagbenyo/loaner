@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="{{asset('datatables.min.css')}}"/>

@endsection
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="row">
                <div class="col-md-6">
                    <h3>Client Details</h3>
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>{{$client->fname. ' '.$client->lname}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{$client->telephone1}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$client->paddress}}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h3>Financial Information</h3>
                    <table class="table">
                        <tr>
                            <td>Account Balance</td>
                            <td style="font-weight: bold">{{$client->account->balance}}</td>
                        </tr>
                        <tr>
                            <td>Available Loan Balance</td>
                            <td style="font-weight: bold">{{$client->account->loan_balance}}</td>
                        </tr>
                        <tr>
                            <td>Total Loan Granted</td>
                            <td style="font-weight: bold">{{$client->account->loanTaken()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <h3>Account transactions</h3>
            <table class="table table-bordered" id="clientTransact">
                <thead>
                <tr>
                    <th>Details</th>
                    <th>Transaction</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($client->transactions) && count($client->transactions))
                    @foreach($client->transactions as $t)
                        <tr>
                            <td title="{{$t->details}}">{{substr($t->details,0,40)}}</td>
                            <td>
                                 @if($t->type =='deposit')
                                    
                                        Deposit
                                       
                                    @elseif($t->type=='withdrawal')
                                        Withdrawal
                                    @elseif($t->type=='lcredit')
                                        Loan Payment
                                    @elseif($t->type=='ldebit')
                                        Loan Withdrawal
                                    @endif
                            </td>
                            <td>{{$t->amount}}</td>
                            <td>{{$t->created_at->toDateTimeString() }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No client yet.</td>
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
