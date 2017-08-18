<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuppliersController extends Controller
{
    /**
     * SuppliersController constructor.
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
        return view('suppliers.index',['suppliers'=>Supplier::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('suppliers.create');
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
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'contact' => 'required',
            'location' => 'required',
            'address' => 'required',
            'organization' => '',
            'residence' => 'required',
            'house' => '',
        ]);
        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('message',$request->name.' has been created successfully');
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
        return view('suppliers.edit',['supplier'=>Supplier::find($id)]);

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
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'contact' => 'required',
            'location' => 'required',
            'address' => 'required',
            'organization' => '',
            'residence' => 'required',
            'house' => '',
        ]);

        $supplier = Supplier::find($id);
        $supplier->name= $request->name;
        $supplier->contact= $request->contact;
        $supplier->email= $request->email;
        $supplier->address= $request->address;
        $supplier->location= $request->location;
        $supplier->residence= $request->residence;
        $supplier->house= $request->house;
        $supplier->organization= $request->organization;
        $supplier->user_id = Auth::user()->id;

        $supplier->save();

        return redirect()->route('suppliers.index')->with('message',$request->name.' has been updated successfully');
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

        Supplier::find($id)->delete();
        return redirect()->route('suppliers.index')->with('message','supplier has been deleted successfully');


    }
}
