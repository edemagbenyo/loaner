@extends('layouts.app')
@section('content')

    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{session('message')}}
            </div>
        @endif
        <div class="col-md-10 col-md-offset-1">
            <h3>Loan applications</h3>
            <table class="table table-bordered" id="clientTransact">
                <thead>
                <tr>
                    <th>Name
                        @if(Auth::user()->can(["manage-loans","add-loans"]))
                            <a href="{{route('loans.create')}}" class="pull-right">Add loan <span
                                        class="glyphicon glyphicon-plus-sign"></span>

                            </a>
                        @endif
                    </th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($loans) && count($loans))
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{$loan->loanee->fname. ' ' .$loan->loanee->lname }}</td>
                            <td>{{$loan->status}}
                            </td>
                            <td>
                                @if(Auth::user()->can(["manage-loans","edit-loans"]))
                                    <a class="btn btn-default" href="{{route('loans.edit',$loan->id)}}">Edit</a>
                                @endif
                                @if(Auth::user()->can(["manage-loans","view-loans"]))
                                    <a class="btn btn-primary" href="{{route('loans.show',$loan->loanid)}}">View</a>
                                @endif
                                @if(Auth::user()->can(["manage-loans","delete-loans"]))
                                    {!! Form::open(['route' => ['loans.destroy', $loan->id],'method'=>'post','id'=>'delete-loan','style'=>'display:inline-block']) !!}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger">Archive</button>
                                    {!! Form::close() !!}
                                @endif

                            </td>
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