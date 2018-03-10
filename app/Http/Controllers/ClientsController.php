<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //We create and account first before we create a client
        Account::create([
            'accountid'=>str_random(25),
            'accountno'=>random_int(1000000000,9999999999),
            'balance'=>'0.00',
            'type'=>'saving',
            'previous_balance'=>'0.00',
            'user_id'=>Auth::user()->userid
            ]);
            
            $this->validate($request, [
                'title' => 'required',
                'account_id'=>$account->accountid,
                'clientid'=>str_random(20),
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'oname' => 'max:255',
                'email' => 'email|max:255',
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
                'user_id'=>Auth::user()->userid
        ]);


            
    
        Client::create($request->all());
        return redirect()->route('clients.index')->with('message',$request->name.' has been created successfully');
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
        return view('clients.edit',['client'=>Client::find($id)]);

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
            'email' => 'email|max:255',
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

        $client = Client::find($id);
        $client->title= $request->title;
        $client->fname= $request->fname;
        $client->lname= $request->lname;
        $client->oname= $request->oname;
        $client->email= $request->email;
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
        $client->user_id = Auth::user()->id;

        $client->save();

        return redirect()->route('clients.index')->with('message',$request->name.' has been updated successfully');
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

        Client::find($id)->delete();
        return redirect()->route('clients.index')->with('message','Client has been deleted successfully');


    }
}
