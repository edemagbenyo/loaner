@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="row">
                <div class="col-md-6">
                    <h3>User Details</h3>
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>{{$client->name}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{$client->contact}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$client->email}}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h3>Financial Information</h3>
                    <table class="table">
                        <tr>
                            <td>Total</td>
                            <td style="font-weight: bold">{{number_format($client->account()->where(['type'=>'d'])->sum('amount'))}}</td>
                        </tr>
                        <tr>
                            <td>Payment made</td>
                            <td style="font-weight: bold">{{number_format($client->account()->where(['type'=>'c'])->sum('amount'))}}</td>
                        </tr>
                        <tr>
                            <td>Balance</td>
                            <td style="font-weight: bold">{{$client->balance()}}</td>
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
                @if(isset($client->account) && count($client->account))
                    @foreach($client->account as $t)
                        <tr>
                            <td title="{{$t->details}}">{{substr($t->details,0,40)}}</td>
                            <td>{{($t->type=='c')?"Payment":"Sales"}}</td>
                            <td>{{$t->amount}}</td>
                            <td>{{$t->created_at->format('l jS \\of F Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No client yet.</td>
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
