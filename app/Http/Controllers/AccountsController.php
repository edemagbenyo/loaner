<?php

namespace App\Http\Controllers;

use App\Cashbook;
use App\Client;
use App\Transaction;
use App\Loan;
use App\Sale;
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
            'account_id'=>'required',
            'type'=>'required',
            'depositor_name'=>'required',
        ],$message);

        dd($request->all());

        $account = Account::where('accountid',$request->account_id)->first();

        //account_id, amount, depositor_name, depositor_telephone, details
        //calculate balance
        $previous_balance = $client->account->balance;
        $loan_balance = $client->account->loan_balance;

        switch ($request->type) {
            case 'deposit':
               depositTransaction($account,$request->amount);
                break;
            
            case 'withdrawal':
                withdrawalTransaction($account, $request->amount);
                break;
            
            case 'lcredit':
               loanTransaction($account, $request->amount,'credit');
               break;
               
               case 'ldebit':
               loanTransaction($account, $request->amount,'debit');
                break;
            
            default:
                # code...
                break;
        }

       

        return redirect()->route('accounts.cashbook')->with('message','Record has been saved');
    }
   

    public function getAccountLoanBalance(Request $request)
    {
        if($request->accountid){
            $client = Client::where('account_id',$request->accountid)->first();
            $data = [
                'account_bal'=>$client->account->balance,
                'loan_bal'=>$client->account->loan_balance
            ];
            return response()->json($data);
        }else{
            return response()->json($request->all());
        }

    }

   
    /**
    * Record Transactions
    *
    **/
    public function recordTransaction(){
       
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
    public function depositTransaction(){
         $balance = doubleval($previous_balance) + doubleval($request->amount);

                //Update Account informatioin
                $account->previous_balance = $previous_balance;
                $account->balance =  doubleval($previous_balance) + doubleval($request->amount);;
                $account->save() ;
    }

    /**
    * Withdrawal Transaction
    *
    **/
    public function withdrawalTransaction(){
    
    }

    /**
    * Loan Transaction
    *
    **/
    public function loanTransaction(){
    
    }
   
    public function clients()
    {
        return view('accounts.clients.index', ['clients' => Client::all()]);
    }

    public function viewClientAccount($id)
    {
        return view('accounts.clients.account',['client'=>Client::find($id)]);
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
        return view('accounts.Loans.index', ['Loans' => Loan::all()]);
    }


}
