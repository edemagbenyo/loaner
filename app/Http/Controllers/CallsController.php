<?php

namespace App\Http\Controllers;

use App\Call;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('calls.index',['calls'=>Call::all(),'clients'=>Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'enquiry'=>$request->enquiry,
            'action'=>$request->action,
            'result'=>$request->result,
            'customer_id'=>$request->client_id,
            'name'=>$request->name,
            'contact'=>$request->contact,
            'call_date_time'=>$request->call_date_time,
            'status'=>5,
            'user_id'=>Auth::user()->id
        ];

        Call::create($data);
        return response()->json(['result'=>true]);
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
        return view ('calls.edit',['call'=>Call::find($id),'clients'=>Client::all()]);
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
//        //
//        $data = [
//            'enquiry'=>$request->enquiry,
//            'action'=>$request->action,
//            'result'=>$request->result,
//            'customer_id'=>$request->client_id,
//            'name'=>$request->name,
//            'contact'=>$request->contact,
//            'call_date_time'=>$request->call_date_time,
//            'status'=>5,
//            'user_id'=>Auth::user()->id
//        ];
//        $call = Call
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
    }
}
