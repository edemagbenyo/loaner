@extends('accounts/index')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>

@endsection

@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Loans Status</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name
                    </th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($loans) && count($loans))
                    @foreach($loans as $loan)
                            <tr>
                                <td>{{$loan->applicant->fname.' '.$loan->applicant->lname}}</td>
                                
                                <td>
                                {{$loan->application->status}}
                                </td>
                                <td>
                                    <a href="{{route('accounts.loan.details',$loan->loanid)}}" class="btn btn-success">View</a>
                                    {{-- <a href="">V</a> --}}
                                </td>
                                {{--<td>Delete</td>--}}
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

