@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center; text-decoration:underline">
            
             New Loan Application   </h3>
            <div class="alert alert-danger" style="display:none">
                <p id="error"></p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('loans.store')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" id="hidden-data" data-url="{{url('accounts/loaninfo')}}">
                <h3>Section A - Member information</h3>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Member name</label>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <select name="account_id" id="client_set" class="form-control">
                        <option value="">Select member</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->account_id}}" {{(old('account_id') == $client->account_id ? 'selected': '')}}  >{{$client->lname.'  '.$client->fname . ' - '. $client->telephone1 . ' - no: ' .$client->account->accountno}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>

                            
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="amount" class="control-label">Amount</label>

                            <input id="amount" type="number" class="form-control" name="amount"
                                   value="{{old('amount')}}" required>

                            @if ($errors->has('amount'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amountinwords" class="control-label">Amount in word</label>
                    <input id="amountinwords" name= "amountinwords" readonly type="text" class="form-control">
                </div>

                <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
                    <label for="purpose" class="control-label">Purpose of loan</label>

                    <textarea name="purpose" id="purpose" rows="3" class="form-control">{{old('purpose')}}</textarea>

                    @if ($errors->has('purpose'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('repaymentperiod') ? ' has-error' : '' }}">
                   <div class="row">
                    <div class="col-md-6">
                            <label for="repaymentperiod" class="control-label">Period of Repayment</label>
                            <select id="repaymentperiod" class="form-control" name="repaymentperiod" required>
                                <option value="">Select Payment period</option>
                                {{-- <option value="1month">1 Month</option> --}}
                                {{-- <option value="3months">3 Months</option> --}}
                                <option value="6months" {{(old('repaymentperiod') == '6months' ? 'selected' : '')}}>6 Months</option>
                                <option value="1year" {{(old('repaymentperiod') == '1year' ? 'selected' : '')}} >1 Year</option>
                            </select>

                            @if ($errors->has('repaymentperiod'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('repaymentperiod') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="currency">Other</label>
                            <input type="text" class="form-control" name="repaymentperiod2">
                        </div>
                   </div>
                </div>
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <div class="row">
                
                        <div class="col-md-6">
                            <label for="currency">Amount to pay</label>
                            <input id="totalpay" type="text" class="form-control" readonly >
                        </div>

                        <div class="col-md-6">
                            <label for="currency">Monthly Payment</label>
                            <input id="monthlypay" type="text" class="form-control" readonly >
                            
                        </div>
                    </div>
                </div>
                
                <h3>Section B - Guarantors </h3> 
                
                @for($i=1; $i<=3; $i++)
                <div class="form-group">
                    <label for="">Guarantor *  </label>
                    <div class="row">
                        <div class="col-md-4">
                            <select name="guar{{$i}}" id="" class="form-control">
                            <option value="">Select Guarantor</option>
                                @foreach ($guarantors as $client)
                                    <option value="{{$client->clientid}}">{{$client->lname.' - '.$client->fname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input id="amount" type="text" name="amount{{$i}}" class="form-control width" placeholder="Amount">
                        </div>
                        <div class="col-md-4">
                            <input id="height" type="text" class="form-control guarantor" name="date{{$i}}"
                                   placeholder="Date" value="{{Carbon\Carbon::now()->toDateString()}}" required>
                        </div>
                    </div>
                </div>
            @endfor

                <h3>Section C - Treasurers information</h3>

                <div class="form-group{{ $errors->has('repaymentperiod') ? ' has-error' : '' }}">
                   <div class="row">
                    <div class="col-md-4">
                            <label >Member savings balance</label>
                            <input type="text" readonly class="form-control" id="savings_balance" >
                        </div>
                        <div class="col-md-4">
                            <label>Previous Loan balance</label>
                            <input type="text" readonly class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Current of interest on loans</label>
                            <input type="text" readonly class="form-control" value="20%">
                            
                        </div>
                   </div>
                </div>
                <div class="form-group">
                    <div style="margin-top: 10px;">
                        <button type="submit" id="submitit" class="create btn btn-primary" disabled>
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection