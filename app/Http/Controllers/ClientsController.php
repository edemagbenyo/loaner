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
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'contact' => 'required',
            'location' => 'max:255',
            'address' => 'required',
            'organization' => '',
            'residence' => '',
            'house' => '',
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
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'contact' => 'required',
            'location' => 'required',
            'address' => 'required',
            'organization' => '',
            'residence' => 'required',
            'house' => '',
        ]);

        $client = Client::find($id);
        $client->name= $request->name;
        $client->contact= $request->contact;
        $client->email= $request->email;
        $client->address= $request->address;
        $client->location= $request->location;
        $client->residence= $request->residence;
        $client->house= $request->house;
        $client->organization= $request->organization;
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
