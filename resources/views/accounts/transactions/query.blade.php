@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="{{asset('datatables.min.css')}}"/>

@endsection
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Transactions</h3>
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>
                        Account Number
                    </th>
                    <th>Account Holder</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    {{-- <th>Payment Progress</th> --}}
                    <th>Transaction By</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($transactions) && count($transactions))
                    @foreach($transactions as $transact)
                        @if(count($transact))
                            <tr>
                                <td>{{$transact->account->accountno}}</td>
                                <td>{{$transact->account->client->fname. ' '.$transact->account->client->lname}}</td>
                                <td>
                                    @if($transact->type =='deposit')
                                    
                                        Deposit
                                       
                                    @elseif($transact->type=='withdrawal')
                                        Withdrawal
                                    @elseif($transact->type=='lcredit')
                                        Loan Payment
                                    @elseif($transact->type=='ldebit')
                                        Loan Payment
                                    @endif

                                </td>
                                <td>{{$transact->amount}}</td>
                                <td>{{$transact->created_at}}</td>
                                <td>{{$transact->user->name}}</td>
                            </tr>
                            @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No transact yet.</td>
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
