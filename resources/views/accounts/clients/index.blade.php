@extends('accounts/index')
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Clients Account</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name
                    </th>
                    <th>Payment Progress</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($clients) && count($clients))
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        60%
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if(Auth::user()->can(["manage-clients","edit-clients"]))
                                    <a class="btn btn-success" href="{{route('clients.edit',$client->id)}}">View Account</a>
                                @endif
                            </td>
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
