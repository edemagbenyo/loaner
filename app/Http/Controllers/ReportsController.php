<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\LoanReport;
use App\RegistrationReport;
use App\AccountReport;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('reports/loans');
    }
    public function registration()
    {
        //
        return view('reports/registration');
    }
    public function interest()
    {
        //
        return view('reports/interest');
    }
    public function account()
    {
        //
        return view('reports/account');
    }


    public function postInterest(Request $request){
        $reports = LoanReport::interest($request->start_date, $request->end_date);
        
        $period = ['start_date'=>$request->start_date, 'end_date'=>$request->end_date];
        return view('reports/interest',compact('reports','period'));
    }


    public function postRegistration(Request $request){
        $reports = RegistrationReport::periodic($request->start_date, $request->end_date);
        $period = ['start_date'=>$request->start_date, 'end_date'=>$request->end_date];
        return view('reports/registration',compact('reports','period'));
    }

    /**
     * 
     * @return view
     * 
     */
    public function postLoan(Request $request){
        
        $reports = LoanReport::periodic($request->start_date, $request['end_date']);
        $period = ['start_date'=>$request->start_date, 'end_date'=>$request->end_date];
        return view('reports.loans',compact('reports','period'));

    }
    /**
     * 
     * @return view
     * 
     */
    public function postAccount(Request $request){
        
        if($request->type == 'savings'){

            $reports = AccountReport::savings($request->start_date, $request['end_date']);
            $period = ['start_date'=>$request->start_date, 'end_date'=>$request->end_date];
            return view('reports.account',compact('reports','period'));
        }else{
            $reports = AccountReport::withdrawal($request->start_date, $request['end_date']);

            $period = ['start_date'=>$request->start_date, 'end_date'=>$request->end_date];
            return view('reports.account',compact('reports','period'));
        }

    }

}
