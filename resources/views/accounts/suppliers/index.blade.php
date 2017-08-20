@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Suppliers Account</h3>
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Name
                    </th>
                    <th>Last Payment</th>
                    <th>Payment Progress</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($suppliers) && count($suppliers))
                    @foreach($suppliers as $supplier)
                        @if(isset($supplier->account) && count($supplier->account))
                            <tr>
                                <td>{{$supplier->name}}</td>
                                <td title="{{$supplier->lastPayment()->created_at->toDateTimeString()}}">{{$supplier->lastPayment()->amount}}  on {{$supplier->lastPayment()->created_at->toDateString()}} </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:{{$supplier->percentPaid()}}">
                                            {{$supplier->percentPaid()}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(Auth::user()->can(["manage-suppliers","account-suppliers"]))
                                        <a class="btn btn-success" href="{{route('view.supplier.account',$supplier->id)}}">View Account</a>
                                    @endif
                                </td>
                            </tr>
                            @endif
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
