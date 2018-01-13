<?php

namespace App\Http\Controllers;

use App\Cashbook;
use App\Client;
use App\ClientAccount;
use App\Land;
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
        $message=[
            'land_id.required'=>"Kindly select a land and refill the information"
        ];
        //Validation
        $this->validate($request,[
            'client_id'=>'required',
            'land_id'=>'required',
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

    public function landStatus()
    {
        return view('accounts.lands.index', ['lands' => Land::all()]);
    }


}
