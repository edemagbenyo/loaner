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
            <h5>
                <a href="{{route('query.sales',['fixed'=>'today'])}}" class="btn btn-success">Today's transactions</a>
                <a href="{{route('query.sales',['fixed'=>'yesterday'])}}" class="btn btn-info">Yesterday transactions</a>
            </h5>
            <h3 style="text-align: center">GEC transactions</h3>
            <form action="{{route('accounts.post.sales')}}" method="post">
                {{csrf_field()}}
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Member Name</label>
                            <select name="account_id" id="members" class="form-control" required>
                                <option value="">Select a client</option>
                                @foreach($clients as $c)
                                    <option value="{{$c->account_id}}">{{$c->fname.' '.$c->lname . ' - ' .$c->account->accountno}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       <div class="col-md-6">
                           <label for="name">Type of Transaction</label>
                           <select name="type" id="transactions" class="form-control">
                               <option value="">Select a land</option>
                               <option value="deposit">Deposit</option>
                               <option value="withdrawal">Withdrawal</option>
                               <option value="lcredit">Loan Credit</option>
                               {{-- <option value="ldebit">Loan Debit</option> --}}
                           </select>
                       </div>
                       <div class="col-md-6">
                           <label for="">Amount</label>
                           <input type="text" id="payment" name="amount" class="form-control" required>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-6">
                           <label for="">Deposited By</label>
                           <input type="text" id="acc_balance" name="depositor_name" class="form-control" >
                       </div>
                       <div class="col-md-6">
                           <label for="">Depositor Telephone NUmber</label>
                           <input type="text" id="loan_balance" name="depositor_telephone" class="form-control" >
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-6">
                           <label for="">Account Balance</label>
                           <input type="text" id="acc_balance" class="form-control" readonly>
                       </div>
                       <div class="col-md-6">
                           <label for="">Loan Balance</label>
                           <input type="text" id="loan_balance" class="form-control" readonly>
                       </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                       
                       <div class="col-md-12">
                           <label for="">Details</label>
                           <textarea name="details" id="" cols="30" rows="3" class="form-control">{{old('details')}}</textarea>
                       </div>

                   </div>
                </div>
                

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <button type="submit" class="btn btn-warning">Make Transaction</button>
            </form>
        </div>
    </div>
@endsection
