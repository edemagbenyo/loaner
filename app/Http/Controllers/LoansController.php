<?php

namespace App\Http\Controllers;

use App\Cashbook;
use App\Loan;
use App\Supplier;
use App\SupplierAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('lands.index',['lands'=>Land::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('loans.application',['suppliers'=>Supplier::all()]);
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
            'name' => 'required',
            'price' => 'required',
            'location' => 'required',
            'date_purchased' => 'required',
            'measure' => 'required',
            'size' => '',
            'description' => '',
            'supplier_id' => 'required',
        ]);

        $land = Land::create($request->all());

        //We fill the supplier account
        SupplierAccount::create([
            'supplier_id'=>$request->supplier_id,
            'land_id'=>$land->id,
            'amount'=>$request->price,
            'details'=>'Purchase of '.$request->name,
            'type'=>'c',
            'currency'=>$request->currency,
            'user_id'=>Auth::user()->id
        ]);

        if($request->payment > 0){
            //Meaning we are making some payment to the supplier
            SupplierAccount::create([
                'supplier_id'=>$request->supplier_id,
                'land_id'=>$land->id,
                'amount'=>$request->payment,
                'details'=>'Payment for '.$request->name,
                'type'=>'d',
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id
            ]);

            //Update the cashbook
            Cashbook::create([
                'amount'=>$request->payment,
                'type'=>'d',
                'currency'=>$request->currency,
                'user_id'=>Auth::user()->id,
                'open'=>0,
                'close'=>0,
                'details'=>'Payment for '.$request->name,
            ]);

        }

        return redirect()->route('lands.index')->with('message',$request->name.' has been created successfully');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('lands.edit',['land'=>Land::find($id) , 'suppliers'=>Supplier::all()]);

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
        $land->name= $request->name;
        $land->price= $request->price;
        $land->date_purchased= $request->date_purchased;
        $land->measure= $request->measure;
        $land->currency= $request->currency;
        $land->size= $request->size;
        $land->location= $request->location;
        $land->description= $request->description;
        $land->supplier_id= $request->supplier_id;
        $land->user_id= Auth::user()->id;

        $land->save();

        return redirect()->route('lands.index')->with('message',$request->name.' has been updated successfully');
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

        Land::find($id)->delete();
        return redirect()->route('lands.index')->with('message','land has been deleted successfully');
    }


}
