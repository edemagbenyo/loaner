<?php

namespace App\Http\Controllers;

use App\Cashbook;
use App\Client;
use App\ClientAccount;
use App\Land;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AccountsController extends Controller
{
    //

    public function index()
    {
        return view('accounts.sales', ['clients' => Client::all(), 'lands' => Land::all()]);
    }

    /**
     * Either credit or debit the company account
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cashbook()
    {
        //Calculate the opening balance
        $credit = Cashbook::where('type', 'c')->sum('amount');
        $debit = Cashbook::where('type', 'd')->sum('amount');
        $open = $credit - $debit;

        return view('accounts.cash-book', ['clients' => Client::all(), 'lands' => Land::all(),'open'=>$open]);
    }

    /**
     * Post a cash transaction
     */
    public function postCashbook(Request $request)
    {
        if(!empty($request->client_id)){
            Cashbook::create([
                'client_id'=>$request->client_id,
                'amount'=>$request->amount,
                'open'=>0,
                'close'=>0,
                'details'=>$request->details,
                'type'=>$request->type,
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id
            ]);

            //Update the client account
            ClientAccount::create([
                'client_id'=>$request->client_id,
                'amount'=>$request->amount,
                'details'=>$request->details,
                'type'=>$request->type,
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id,
                'land_id'=>0,
            ]);
        }else{
            Cashbook::create([
                'client_id'=>$request->client_id, #this is supposed be client_id
                'amount'=>$request->amount,
                'open'=>0,
                'close'=>0,
                'details'=>$request->details,
                'type'=>$request->type,
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id
            ]);
        }


        return redirect()->route('accounts.cashbook')->with('message','Record has been saved');
    }

    public function postSales(Request $request)
    {
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
            'land_id'=>$request->land_id,
        ]);

        if($request->payment > 0){
            //Update the client account
            ClientAccount::create([
                'client_id'=>$request->client_id,
                'amount'=>$request->payment,
                'details'=>'Payment for the land',
                'type'=>'c',
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id,
                'land_id'=>$request->land_id,
            ]);
        }
        return redirect()->route('accounts.index')->with('message','Sales has been made');
    }

    public function clients()
    {
        return view('accounts.clients.index', ['clients' => Client::all()]);
    }


}
