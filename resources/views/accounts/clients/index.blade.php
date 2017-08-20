@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Clients Account</h3>
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
                @if(isset($clients) && count($clients))
                    @foreach($clients as $client)
                        @if(count($client->account))
                            <tr>
                                <td>{{$client->name}}</td>
                                <td title="{{$client->lastPayment()->created_at->toDateTimeString()}}">{{$client->lastPayment()->amount}}  on {{$client->lastPayment()->created_at->toDateString()}} </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:{{$client->percentPaid()}}">
                                            {{$client->percentPaid()}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(Auth::user()->can(["manage-clients","account-clients"]))
                                        <a class="btn btn-success" href="{{route('view.client.account',$client->id)}}">View Account</a>
                                    @endif
                                </td>
                            </tr>
                            @endif
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
