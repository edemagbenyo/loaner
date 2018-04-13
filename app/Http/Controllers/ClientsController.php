<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Auth;
use App\Account;
use App\Nextofkin;

class ClientsController extends Controller
{
    /**
     * ClientsController constructor.
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
        return view('clients.index',['clients'=>Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $acctno = time();
        return view('clients.create',compact('acctno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'oname' => 'max:255',
            'email' => 'email|max:255',
            'telephone1' => 'required',
            'paddress' => 'max:255',
            'raddress' => 'max:255',
            'pob' => 'required|max:255',
            'dob' => 'required|max:255',
            'sex' => 'required|max:255',
            'marital' => 'required|max:255',
            'profession' => 'required|max:255',
            'spousename' => 'required|max:255',
            'spousetel' => 'required|max:255',
            'next_name' => 'required|max:255',
            'next_tel1' => 'required|max:255',
            'next_address' => 'required|max:255',
            'relationship' => 'required|max:255',
    ]);
        //We create and account first before we create a client
        $account = Account::create([
        'accountid'=>str_random(25),
        'accountno'=>$request->acctno,
        'balance'=>'0.00',
        'type'=>'saving',
        'previous_balance'=>'0.00',
        'user_id'=>Auth::user()->userid
        ]);
        
        if($account){
        //Create a new member
        $client = Client::create([
            'clientid'=>str_random(20),
            'account_id'=>$account->accountid,
            'title'=>$request->title,
            'lname'=>$request->lname,
            'fname'=>$request->fname,
            'oname'=>$request->oname,
            'telephone1'=>$request->telephone1,
            'telephone2'=>$request->telephone2,
            'paddress'=>$request->paddress,
            'raddress'=>$request->raddress,
            'pob'=>$request->pob,
            'dob'=>$request->dob,
            'sex'=>$request->sex,
            'marital'=>$request->marital,
            'profession'=>$request->profession,
            'spousename'=>$request->spousename,
            'spousetel'=>$request->spousetel,
            'user_id'=>Auth::user()->userid
            
        ]);

       if($client){
            //Add next of kin
                Nextofkin::create([
                    'nextofkin'=>str_random(20),
                    'client_id'=>$client->clientid,
                    'name'=>$request->next_name,
                    'telephone1'=>$request->next_tel1,
                    'address'=>$request->next_address,
                    'relationship'=>$request->relationship,
                    'user_id'=>Auth::user()->userid
                ]);
            }
        }
            
        return redirect()->route('clients.index')->with('message','Account has been created successfully');
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
    }


    /**
     * Return a json value of the specified client
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @internal param $id
     */
    public function apiClientOne(Request $request)
    {
        return response()->json(Client::find($request->id));
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
        $client = Client::find($id);
        return view('clients.edit',['client'=>$client,'nok'=>$client->nok]);

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
            'title' => 'required',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'oname' => 'max:255',
            'telephone1' => 'required',
            'telephone2' => 'required',
            'paddress' => 'required|max:255',
            'raddress' => 'required|max:255',
            'pob' => 'required|max:255',
            'dob' => 'required|max:255',
            'sex' => 'required|max:255',
            'marital' => 'required|max:255',
            'profession' => 'required|max:255',
            'spousename' => 'required|max:255',
            'spousetel' => 'required|max:255',
        ]);

        $client = Client::where('clientid',$id)->first();
        // dd($client );
        $client->title= $request->title;
        $client->fname= $request->fname;
        $client->lname= $request->lname;
        $client->oname= $request->oname;
        $client->telephone1= $request->telephone1;
        $client->telephone2= $request->telephone2;
        $client->paddress= $request->paddress;
        $client->raddress= $request->raddress;
        $client->pob= $request->pob;
        $client->dob= $request->dob;
        $client->sex= $request->sex;
        $client->marital= $request->marital;
        $client->profession= $request->profession;
        $client->spousename= $request->spousename;
        $client->spousetel= $request->spousetel;

        $client->save();
        if($client){
            //Add next of kin
            $nok = Nextofkin::where('client_id',$client->clientid)->first();
            $nok->name = $request->next_name;
            $nok->telephone1 = $request->telephone1;
            $nok->address = $request->next_address;
            $nok->relationship = $request->relationship;
            $nok->user_id = Auth::user()->userid;
            $nok->save();
            }
        
        return redirect()->route('clients.index')->with('message',$request->fname.' has been updated successfully');
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
        
        //Client::find($id)->delete();
        return redirect()->route('clients.index')->with('message','Client has been deleted successfully');


    }
}
