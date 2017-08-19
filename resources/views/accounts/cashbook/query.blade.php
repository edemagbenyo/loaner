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
                    <h3>{{$date}} Balances</h3>
                    <table class="table">
                        <tr>
                            <input type="hidden" id="hidden-data" data-date="{{$date}}" data-url="{{route('get.openclose')}}" >
                            <td>Opening Balance</td>
                            <td id="open"> - </td>
                        </tr>
                        <tr>
                            <td>Closing Balance</td>
                            <td id="current"> - </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>{{$date}} Transaction Details</h3>
                    <table class="table">
                        <tr>
                            <td>Cash In Total</td>
                            <td>{{number_format( $in = $sales->where('type','c')->sum('amount'))}}</td>
                        </tr>
                        <tr>
                            <td>Cash Out Total</td>
                            <td>{{number_format($out = $sales->where('type','d')->sum('amount'))}}</td>
                        </tr>
                        <tr>
                            <td>Balance</td>
                            <td>{{number_format($in-$out)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <h3>Cashbook for {{$date}}</h3>
            <table class="table table-bordered" id="queryCash">
                <thead>
                <tr>
                    <th>Memo</th>
                    <th>Cash In</th>
                    <th>Cash Out</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($sales) && count($sales))
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{$sale->details}}</td>
                            <td>{{($sale->type == 'c') ? $sale->amount : "-"}}</td>
                            <td>{{($sale->type == 'd') ? $sale->amount : "-"}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No Cashbook record yet.</td>
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