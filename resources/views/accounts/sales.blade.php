@extends('accounts/index')
@section('account-content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="background: #c7ddef">
            @if($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {{session('message')}}
                </div>
            @endif
            <div class="js_message">
                <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <p class="js_message_content"></p>
                </div>
            </div>
            <h5>
                <a href="{{route('query.sales',['fixed'=>'today'])}}" class="btn btn-success">Today's transactions</a>
                <a href="{{route('query.sales',['fixed'=>'yesterday'])}}" class="btn btn-info">Yesterday transactions</a>
            </h5>
            <h3 style="text-align: center">GEC transactions</h3>
            <form action="{{route('accounts.post.transact')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" id="hidden-data" data-loan-url="{{route('get.accloanbal')}}"  data-withdrawstate="{{route('get.withdrawstate')}}" data-loanstate="{{route('get.loanstate')}}" data-loanwithdrawstate="{{route('get.loanwithdrawstate')}}">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Member Name</label>
                            <select name="accountid" id="members" class="form-control" required>
                                <option value="">Select a client</option>
                                @foreach($clients as $c)
                                    <option value="{{$c->account_id}}" {{ ($c->account_id == old('account_id'))?"selected":"" }}>{{$c->fname.' '.$c->lname . ' - ' .$c->account->accountno}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       <div class="col-md-6">
                           <label for="name">Type of Transaction</label>
                           <select name="type" id="transactions" class="form-control" required>
                               <option value="">Select the type of transaction</option>
                               <option value="deposit" {{ ("deposit" == old('type'))?"selected":"" }}>Deposit</option>
                               <option value="withdrawal" {{ ("withdrawal" == old('type'))?"selected":"" }}>Withdrawal</option>
                               <option value="lcredit" {{ ("lcredit" == old('type'))?"selected":"" }}>Pay Loan</option>
                               <option value="dcredit" {{ ("dcredit" == old('type'))?"selected":"" }}>Withdraw Loan</option>
                               {{-- <option value="ldebit">Loan Debit</option> --}}
                           </select>
                       </div>
                       <div class="col-md-6">
                           <label for="">Amount</label>
                           <input type="number" id="amount" name="amount" class="form-control"value="{{old('amount',0)}}" required>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-6">
                           <label for="">Transactor</label>
                           <input type="text" id="depositor" name="depositor_name" class="form-control" value="{{old('depositor_name')}}" required>
                       </div>
                       <div class="col-md-6">
                           <label for="">Transactor Telephone NUmber</label>
                           <input type="number" id="telephone" name="depositor_telephone" class="form-control" value="{{old('depositor_telephone')}}" required>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-6">
                           <label for="">Account Balance</label>
                           <input type="number" id="acc_balance" class="form-control" readonly>
                       </div>
                       <div class="col-md-6">
                           <label for="">Available Loan Balance</label>
                           <input type="number" id="loan_balance" class="form-control" readonly>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-12">
                           <label for="">Loan Balance to Pay</label>
                           <input type="number" id="loan_topay" class="form-control" readonly>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-12">
                           <label for="">Details</label>
                           <textarea name="details" id="" cols="30" rows="3" class="form-control">{{old('details','Good transaction!')}}</textarea>
                       </div>

                   </div>
                </div>
                

                <input type="hidden" name="user_id" value="{{Auth::user()->userid}}">
                <button type="submit" class="btn btn-warning" id="submit_transact" >Make Transaction</button>
            </form>
        </div>
    </div>
@endsection
