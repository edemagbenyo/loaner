<?php

namespace App\Http\Controllers;

use App\Cashbook;
use App\Client;
use App\Transaction;
use App\Loan;
use App\Sale;
use App\Account;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AccountsController extends Controller
{
    //

    public function index()
    {
        return view('accounts.sales', ['clients' => Client::all(), 'Loans' => Loan::all()]);
    }


    /**
    * Get transactions
    *
    **/
    public function getTransactions(){
        $transactions =  Transaction::latest()->get();
        return view('accounts.transactions.all',compact('transactions'));
    }

    /**
     * Post a cash transaction
     */
    public function postTransaction(Request $request)
    {
        //validation
         $message=[
            'account_id.required'=>"Select a member.",
            'type.required'=>"Select the type of transaction.",
            'type.depositor_name'=>"Enter the depositor name"
        ];
        //Validation
        $this->validate($request,[
            'accountid'=>'required',
            'type'=>'required',
            'depositor_name'=>'required',
        ],$message);

        // dd($request->all());

        // $account = Account::where('accountid',$request->account_id)->first();

        //account_id, amount, depositor_name, depositor_telephone, details
        //calculate balance
        // $previous_balance = $client->account->balance;
        // $loan_balance = $client->account->loan_balance;

        switch ($request->type) {
            case 'deposit':
               $this->depositTransaction($request);
                break;
            
            case 'withdrawal':
                $this->withdrawalTransaction($request);
                break;
            
            case 'lcredit':
               $this->loanCreditTransaction($request);
               break;
               
            case 'dcredit':
                $this->loanWithdrawTransaction($request);
            break;
            
            default:
                # code...
                break;
        }

       

        return redirect()->back()->with('message','Your transaction has been recorded successfully!');
    }
   

    /**
     * Get the Loan balance of the selected member
     */
    public function getAccountLoanBalance(Request $request)
    {
        if($request->accountid){
            $client = Client::where('account_id',$request->accountid)->first();
            $data = [
                'account_bal'=>$client->account->balance,
                'loan_bal'=>$client->account->loan_balance,
                'loan_topay'=>$client->account->column2
            ];
            return response()->json($data);
        }else{
            return response()->json($request->all());
        }

    }

    /**
    * Get the information of member loan and account balance before withdrawal
    *
    **/
    public function getWithdrawalState(Request $request){
        
        $account = Account::where('accountid',$request->accountid)->first();
        if($request->type == 'withdrawal'){
                    if($account->column2 > 0){
                $data = [
                    'status'=>'loan_active',
                    'message'=>'This member has an unpaid loan. You can\'t make a withdrawal. '
                ];
                return response()->json($data);
            }elseif($account->balance < $request->amount){
                $data = [
                    'status'=>'balance_insufficient',
                    'message'=>'You can\'t redraw more than your current balance.'
                ];
                return response()->json($data);
            }else{
                $data = [
                    'status'=>'ok',
                    'message'=>'Carry on'
                ];
                return response()->json($data);
            }
        }elseif($request->type == 'dcredit'){
            if($account->loan_balance > $request->amount){
                $data = [
                    'status'=>'ok',
                    'message'=>'carry on'
                ];
                return response()->json($data);
            }elseif($account->loan_balance < $request->amount || $account->loan_balance < 0){
                $data = [
                    'status'=>'dcredit_small',
                    'message'=>'You can\'t redraw more than your current loan balance.'
                ];
                return response()->json($data);
            }
        }
    }

    /**
    * Get the state of the loan
    *
    **/
    public function getLoanState(Request $request){
        $account = Account::where('accountid',$request->accountid)->first();
        if($account->column2 && $account->column2 > 0){
            $data = [
                'status'=>'loan_active',
                'message'=>'This member has an unpaid loan.'
            ];
            return response()->json($data);
        }elseif( $account->column2 && $account->column2 < 0){
            $data = [
                'status'=>'no_loan',
                'message'=>'You have no loan. You cannot pay for a loan.'
            ];
            return response()->json($data);
        }else{
            $data = [
                'status'=>'no_loan',
                'message'=>'You have no loan. You cannot pay for a loan.'
            ];
            return response()->json($data);
        }
    }
   
    /**
    * Record Transactions
    *
    **/
    public function recordTransaction($request, $type){
       
        Transaction::create([
                'transactionid'=>str_random(20),
                'client_id'=>$client->clientid,
                'account_id'=>$request->account_id,
                'amount'=>$request->amount,
                'balance'=>$balance,
                'previous_balance'=> $previous_balance,
                'type'=>$request->type,
                'details'=>$request->details,
                'depositor_name'=>$request->depositor_name,
                'depositor_telephone'=>$request->depositor_telephone,
                'depositor_date'=>$request->depositor_name,
            ]);

    }

    /**
    * Deposit Transaction
    *
    **/
    public function depositTransaction($request){
        $account = Account::where('accountid',$request->accountid)->first();
        
        //We update the account table
       $previous_balance = (!empty($account->balance)? $account->balance: 0);
       $balance = doubleval($previous_balance) + doubleval($request->amount);
    //    dd($previous_balance);
        //Update Account informatioin
        $account->previous_balance = doubleval($previous_balance);
        $account->balance = $balance;
        $account->save() ;


        
        //We create a transaction table
        Transaction::create([
            'transactionid'=>str_random(20),
            'client_id' =>$account->client->clientid,
            'account_id'=>$request->accountid,
            'amount'=>$request->amount,
            'balance'=> $balance,
            'previous_balance'=> $previous_balance,
            'type'=>'deposit',
            'details'=>$request->details,
            'depositor_name'=>$request->depositor_name,
            'depositor_telephone'=>$request->depositor_telephone,
            'depositor_date'=>Carbon::today(),
            'user_id'=>Auth::user()->userid

        ]);        
    }

    /**
    * Withdrawal Transaction
    *
    **/
    public function withdrawalTransaction(Request$request){

        $account = Account::where('accountid',$request->accountid)->first();
        
        //We update the account table
       $previous_balance = (!empty($account->balance)? $account->balance: 0);
       $balance = doubleval($previous_balance) - doubleval($request->amount);
    //    dd($previous_balance);
        //Update Account informatioin
        $account->previous_balance = doubleval($previous_balance);
        $account->balance = $balance;
        $account->save() ;


        
        //We create a transaction table
        Transaction::create([
            'transactionid'=>str_random(20),
            'client_id' =>$account->client->clientid,
            'account_id'=>$request->accountid,
            'amount'=>$request->amount,
            'balance'=> $balance,
            'previous_balance'=> $previous_balance,
            'type'=>'withdrawal',
            'details'=>$request->details,
            'depositor_name'=>$request->depositor_name,
            'depositor_telephone'=>$request->depositor_telephone,
            'depositor_date'=>Carbon::today(),
            'user_id'=>Auth::user()->userid

        ]);        
    
    }

    /**
    * Loan Transaction
    *
    **/
    public function loanCreditTransaction($request){
        
        $account = Account::where('accountid',$request->accountid)->first();
        
        //We update the account table
       $previous_balance = (!empty($account->column2)? $account->column2: 0); //We get the loan to pay amount
       $balance = doubleval($previous_balance) - doubleval($request->amount); //Subtract the amount being paid from the balance of loan to pay

       //Update Account informatioin
        $account->column2 = doubleval($balance);
        $account->save() ;


        
        //We create a transaction table
        Transaction::create([
            'transactionid'=>str_random(20),
            'client_id' =>$account->client->clientid,
            'account_id'=>$request->accountid,
            'amount'=>$request->amount,
            'balance'=> $balance,
            'previous_balance'=> $previous_balance,
            'type'=>'lcredit',
            'details'=>$request->details,
            'depositor_name'=>$request->depositor_name,
            'depositor_telephone'=>$request->depositor_telephone,
            'depositor_date'=>Carbon::today(),
            'user_id'=>Auth::user()->userid

        ]);        
    
    }
    /**
    * Loan Transaction
    *
    **/
    public function loanWithdrawTransaction($request){
        // dd($request->all());
        $account = Account::where('accountid',$request->accountid)->first();
        
        //We update the account table
       $previous_balance = (!empty($account->loan_balance)? $account->loan_balance: 0);
       $balance = doubleval($previous_balance) - doubleval($request->amount); //Withdrawal will be made from available loan
    //    dd($previous_balance);
        //Update Account informatioin
        $account->loan_balance = doubleval($balance);
        $account->save() ;


        
        //We create a transaction table
        Transaction::create([
            'transactionid'=>str_random(20),
            'client_id' =>$account->client->clientid,
            'account_id'=>$request->accountid,
            'amount'=>$request->amount,
            'balance'=> $balance,
            'previous_balance'=> $previous_balance,
            'type'=>'ldebit',
            'details'=>$request->details,
            'depositor_name'=>$request->depositor_name,
            'depositor_telephone'=>$request->depositor_telephone,
            'depositor_date'=>Carbon::today(),
            'user_id'=>Auth::user()->userid

        ]);        
    
    }
   
    public function clients()
    {

        return view('accounts.clients.index', ['clients' => Client::all()]);
    }

    public function viewClientAccount($id)
    {
        $client = Client::where('clientid',$id)->first();
        
        return view('accounts.clients.account',compact('client'));
    }

    public function suppliers()
    {
        return view('accounts.suppliers.index', ['suppliers' => Supplier::all()]);
    }
    public function viewSupplierAccount($id)
    {
        return view('accounts.suppliers.account',['supplier'=>Supplier::find($id)]);
    }

    public function LoanStatus()
    {
        return view('accounts.loans.index', ['loans' => loan::latest()->get()]);
    }
    /**
    * Get the status details of a loan
    *
    **/
    public function loanStatusDetails($loanid){
        $loan = Loan::where('loanid',$loanid)->first();
         return view('accounts.loans.details', compact('loan'));
    }

    /**
    * Loan Action
    *
    **/
    public function loanAction($action, $loanid){
        $loan = Loan::where('loanid',$loanid)->first();
        $application = Loan::where('loanid',$loanid)->first()->application;

        if($application->status == 'approved' || $application->status == 'denied'){
             return redirect()->back()->with('message','This action cannot be performed!');
        }

        if($action == 'approve'){
            $application->status = 'approved';
            $application->column1 = Auth::user()->userid;
            $application->save();

            //Loan Amount available for redrawal
            $loan_amount = doubleval($application->amount) + doubleval($application->account->loan_balance);
            
            //Loan amount to pay
            $loan_topay = (doubleval($application->amount) *1.2) + doubleval($application->account->column2);
            
            $application->account->loan_balance = $loan_amount;
            $application->account->column2 = $loan_topay; //
            $application->account->save();

            //We get the loan and update its info

            $message="Loan has been approved";

        }
        elseif($action == 'deny'){
            $application->status = 'denied';
            $application->column1 = Auth::user()->userid;
            $application->save();

            //We get the loan

            $message="Loan has been denied.";
        }
        elseif($action == 'review'){
            $application->status = 'pending';
            $application->column1 = Auth::user()->userid;
            $application->save();

            $message="Loan is under review.";
        }
        return redirect()->back()->with('message',$message);
    }

    /**
    * Today
    *
    **/
    public function queryTransact($fixed = NULL ,$date=NULL, $range=NULL){


         if($fixed == 'today'){
            $transactions = Transaction::where('updated_at','>=',Carbon::today())->where('updated_at','<=',Carbon::now())->get();
            $date = 'Today';

        }elseif($fixed =='yesterday'){
            $transactions = Transaction::where('updated_at','>=',Carbon::yesterday())->where('updated_at','<=',Carbon::today())->get();
            $date ='Yesterday';
        }elseif($fixed =='full'){
            $transactions = Cashbook::all();
            $date ='All time';
        }
        
        return view('accounts.transactions.query',compact('transactions'));
    }


}
