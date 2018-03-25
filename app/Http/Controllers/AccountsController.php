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
    public function postTransactions(Request $request)
    {


        $client = Client::where('account_id',$request->account_id)->first();
        //calculate balance
        $previous_balance = $client->account->balance;
        $loan_balance = $client->account->loan_balance;

        switch ($request->type) {
            case 'deposit':
                $balance = doubleval($previous_balance) + doubleval($request->amount);
                break;
            
            case 'withdrawal':
                $balance = doubleval($previous_balance) - doubleval($request->amount);
                break;
            
            case 'lcredit':
                $loan_balance = $loan_balance;
                $balance = doubleval($loan_balance) + doubleval($request->amount); 
                break;
            
            case 'ldebit':
                
                break;
            
            default:
                # code...
                break;
        }

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


        return redirect()->route('accounts.cashbook')->with('message','Record has been saved');
    }
    /**
     * Get the sales for the specified date
     *
     * @param null $fixed
     * @param null $date
     * @param null $range
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function queryCashbook($fixed = NULL ,$date=NULL, $range=NULL)
    {
        if($fixed == 'today'){
            $sales = Cashbook::where('updated_at','>=',Carbon::today())->where('updated_at','<=',Carbon::now())->get();
            $date = 'Today';

        }elseif($fixed =='yesterday'){
            $sales = Cashbook::where('updated_at','>=',Carbon::yesterday())->where('updated_at','<=',Carbon::today())->get();
            $date ='Yesterday';
        }elseif($fixed =='full'){
            $sales = Cashbook::all();
            $date ='All time';
        }

        return view('accounts.cashbook.query',['sales'=>$sales,'date'=>$date]);
    }

    public function getOpeningClosingBalance(Request $request)
    {
        if($request->info_data == 'Today'){
            $in = Cashbook::where('updated_at','<',Carbon::today())->where('type','c')->sum('amount');
            $out = Cashbook::where('updated_at','<',Carbon::today())->where('type','d')->sum('amount');

            $in2 = Cashbook::where('updated_at','<',Carbon::now())->where('type','c')->sum('amount');
            $out2 = Cashbook::where('updated_at','<',Carbon::now())->where('type','d')->sum('amount');


            $balance = $in - $out;
            $balance2 = $in2 - $out2;

            $data = [
                'opening'=>$balance,
                'current'=>$balance2
            ];
            return response()->json($data);
        }

    }

    public function postSales(Request $request)
    {
        $message=[
            'Loan_id.required'=>"Kindly select a Loan and refill the information"
        ];
        //Validation
        $this->validate($request,[
            'client_id'=>'required',
            'Loan_id'=>'required',
        ],$message);
        //Create the sales

        Sale::create($request->all());
        //Create a record in the client account
        //Update the client account
        ClientAccount::create([
            'client_id'=>$request->client_id,
            'amount'=>$request->price,
            'details'=>$request->details,
            'type'=>'d',
            'currency'=>$request->currency,
            'user_id'=>Auth::user()->id,
            'Loan_id'=>$request->Loan_id,
        ]);

        if($request->payment > 0){
            //Update the client account
            ClientAccount::create([
                'client_id'=>$request->client_id,
                'amount'=>$request->payment,
                'details'=>'Payment for the Loan',
                'type'=>'c',
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id,
                'Loan_id'=>$request->Loan_id,
            ]);
        }
        return redirect()->route('accounts.index')->with('message','Sales has been made');
    }

    /**
     * Get the sales for a specified date
     *
     * @param null $fixed
     * @param null $date
     * @param null $range
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function querySales($fixed = NULL ,$date=NULL, $range=NULL)
    {
        if($fixed == 'today'){
            $sales = Sale::where('updated_at','>=',Carbon::today())->where('updated_at','<=',Carbon::now())->get();
            $date = 'Today';
        }elseif($fixed =='yesterday'){
            $sales = Sale::where('updated_at','>=',Carbon::yesterday())->where('updated_at','<=',Carbon::today())->get();
            $date ='Yesterday';
        }

        return view('accounts.sales.query',['sales'=>$sales,'date'=>$date]);
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
