<?php

namespace App\Http\Controllers\Departments;

use App\Price;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Room::paginate(4);
        return view('departments.rooms.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departments.rooms.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        Room::create([
            'name'=>$request->name
        ]);
        return redirect()->route('rooms.index');
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
        $room = Room::find($id);
        return view('departments.rooms.edit',compact('room'));
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
        $this->validate($request,[
            'name'=>'required',
        ]);

        $room = Room::find($id);
        $room->name = $request->name;
        $room->save();

        return redirect()->route('rooms.index');

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
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('rooms.index');
    }

    /**
     * Get the list of all prices
     */
    public function viewPrices()
    {
        $prices = Price::paginate(8);
        return view('departments.rooms.prices',compact('prices'));
    }

    public function setRoomPrice($id)
    {
        $room = Room::find($id);
        return view('departments.rooms.set-price',compact('room'));
    }

    public function postRoomPrice(Request $request)
    {
        $this->validate($request,[
            'price'=>'required',
            'room_type'=>'required',
            'category'=>'required',
        ]);


        Price::create($request->all());
        return redirect()->route('rooms.view.prices');

    }

    public function deleteRoomPrice(Request $request)
    {
        $price = Price::find($request->price);
        $price->delete();
        return redirect()->route('rooms.view.prices');
    }
}
