<?php

namespace App\Http\Controllers;

use App\Application;
use App\Loan;
use App\Client;
use App\Account;
use App\Guarantor;
use App\SupplierAccount;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class LoansController extends Controller
{
    /**
     * LandsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('loans.index',['loans'=>Loan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get guarantor: members with no outstanding balance, or guaranting someone else
        $guarantors = Client::where('guarantor','valid')->get();
        return view('loans.create',['clients'=>Client::all(),'guarantors'=>$guarantors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('We are here');
        //Loan Interest: 20%
        // dd($request->all());

        //TODO: As validation, check if the user has a pending loan,check if the garantor
        //TODO: Check if the applicant is a garantor for another person loan
        //TODO check if applicant has a pending loan
        //TODO: Create the application
        //TODO: Create the loan record

        //TODO: Calculate the monthly payment

        $this->validate($request, [
            'account_id'=>'required',
            'amount'=>'required',
            'purpose'=>'required',
            'repaymentperiod'=>'required',
            'guar1'=>'required'
        ],
        [
            'guar1.required'=>'Guardian is required'
        ]);
        
        // dd($request->all());
        //Application user id
        $client = Client::where('account_id',$request->account_id)->first();
        // $accountid = $client->account->accountid;

        //Save the application
        $appl = Application::create([ 
            'applicationid'=>str_random(20),
            'client_id'=>$client->clientid,
            'account_id'=>$request->account_id,
            'telephone'=>$client->telephone1,
            'amount'=>$request->amount,
            'amountstring'=>$request->amountinwords,
            'purpose'=>$request->purpose,
            'repaymentperiod'=>$request->repaymentperiod,
            'repaymentperiod2'=>$request->repaymentperiod,
            'status'=>'submitted',
            'user_id'=>Auth::user()->userid,
            'column1'=>($request->amount * 1.2) //We save amount to pay here
            ]);
            
            //Add the garantors
            // for($i=1; $i<=3; $i++){
                //1st - 3rd
                if(!empty($request->guar1) && !empty($request->amount1)){
                    echo $request->guar1;
                    Guarantor::create([
                        'guarantorid'=>str_random(20),
                        'application_id'=>$appl->applicationid,
                        'amount'=>$request->input('amount1'),
                        'date'=>$request->input('date1'),
                        'client_id'=>$request->input('guar1'),
                        'user_id'=>Auth::user()->userid
                    ]);
                }
                if(!empty($request->guar2) && !empty($request->amount1)){
                    echo $request->guar2;
                    Guarantor::create([
                        'guarantorid'=>str_random(20),
                        'application_id'=>$appl->applicationid,
                        'amount'=>$request->input('amount2'),
                        'date'=>$request->input('date2'),
                        'client_id'=>$request->input('guar2'),
                        'user_id'=>Auth::user()->userid
                    ]);
                }
                if(!empty($request->guar3) && !empty($request->amount1)){
                    echo $request->guar3;
                    Guarantor::create([
                        'guarantorid'=>str_random(20),
                        'application_id'=>$appl->applicationid,
                        'amount'=>$request->input('amount3'),
                        'date'=>$request->input('date3'),
                        'client_id'=>$request->input('guar3'),
                        'user_id'=>Auth::user()->userid
                    ]);
                }
            // }
            
            if($appl){
                Loan::create([
                    'loanid'=>str_random(20),
                    'client_id'=>$client->clientid,
                    'account_id'=>$request->account_id,
                    'application_id'=>$appl->applicationid,
                    'interestrate'=>0.00,
                    'granted'=>0.00,
                    'loaned'=>0.00,
                    'principal'=>$request->amount,
                    'interest'=>0.00,
                    'monthly'=>$request->monthlypay,
                    'total'=>0.00,
                    'amountstring'=>'',
                    'status'=>'pending',
                    'user_id'=>Auth::user()->userid
            ]);
        }

        return redirect()->route('loans.index')->with('message','Loan application has been submitted successfully pending review.');
    }

    /**
    * Loan information on member
    *
    **/
    public function loanInfo(Request $request){
        //Get the member
        // $client = Client::where('clientid',$request->clientid)->first();
        $account = Account::where('accountid',$request->accountid)->with('loan')->first();
        return response()->json($account);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $loan = Loan::where('loanid',$id)->first();
        return view('loans.view',compact('loan'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('loans.edit',['loan'=>Loan::find($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'location' => 'required',
            'date_purchased' => 'required',
            'measure' => 'required',
            'size' => '',
            'description' => '',
        ]);

        $land = Land::find($id);
       
        $land->save();

        return redirect()->route('loans.index')->with('message',$request->name.' has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $loan = Loan::find($id);
        if($loan->status == 'pending'||$loan->status == 'oncourse'){
            return back()->with('message','This loan cannot be archived');
        }
        $loan->delete();

        return redirect()->route('loans.index')->with('message','land has been deleted successfully');
    }


}
