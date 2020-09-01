<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //fix this later
      
        $members_count = Client::count();
        return view('home',compact('members_count'));
    }
}
