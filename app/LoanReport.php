<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Report;
use App\Application;

class LoanReport extends Model implements Report
{

    private static $start_date, $end_date;

    public function __construct($start_date, $end_date){
        self::$start_date = $start_date;
        self::$end_date = $end_date;
    }
    public static function periodic($start_date, $end_date){
        new self($start_date, $end_date);
        return Application::with('applicant')->whereBetween('created_at',[self::$start_date, self::$end_date])->get();
    }


    public static function interest($start_date, $end_date){
        new self($start_date, $end_date);
        $amount = Application::with('applicant')->whereBetween('created_at',[self::$start_date, self::$end_date])
        ->where(['status'=>'approved'])
        ->sum('amount');
        return $amount * .2;
    }

    

    public function loanPaid(){
        new self($start_date, $end_date);
        return Application::with('applicant')->where(['status'=>'paid'])->whereBetween('created_at',[self::$start_date, self::$end_date])->get();
    }
}
