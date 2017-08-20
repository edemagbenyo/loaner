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
                    <h3>Supplier Details</h3>
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>{{$supplier->name or "N/A"}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{$supplier->contact or "N/A"}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$supplier->email or "N/A"}}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h3>Financial Information</h3>
                    <table class="table">
                        <tr>
                            <td>Total</td>
                            <td style="font-weight: bold">{{number_format($supplier->total())}}</td>
                        </tr>
                        <tr>
                            <td>Payment made to {{$supplier->name or "supplier"}}</td>
                            <td style="font-weight: bold">{{number_format($supplier->paid())}}</td>
                        </tr>
                        <tr>
                            <td>Balance</td>
                            <td style="font-weight: bold">{{$supplier->balance()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <h3>Account transactions</h3>
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Details</th>
                    <th>Transaction</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($supplier->account) && count($supplier->account))
                    @foreach($supplier->account as $t)
                        <tr>
                            <td title="{{$t->details}}">{{substr($t->details,0,40)}}</td>
                            <td>{{($t->type=='c')?"Purchase":"Payment"}}</td>
                            <td>{{$t->amount}}</td>
                            <td>{{$t->created_at->toDateTimeString() }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No supplier yet.</td>
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
