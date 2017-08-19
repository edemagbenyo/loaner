@extends('accounts/index')
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Sales for {{$date}}</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sales Details
                    </th>
                    <th>Client</th>
                    <th>Price</th>
                    <th>Payment</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($sales) && count($sales))
                    @foreach($sales as $sale)
                            <tr>
                                <td>{{$sale->details}}</td>
                                <td>{{$sale->client->name}}</td>
                                <td>{{$sale->price}}</td>
                                <td>{{$sale->payment}}</td>
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
