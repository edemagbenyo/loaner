<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class AccountReport extends Model
{
    private static $start_date, $end_date;

    public function __construct($start_date, $end_date){
        self::$start_date = $start_date;
        self::$end_date = $end_date;
    }

    public function index(){
        return [static::$start_date, static::$end_date];
    }
    public static function savings($start_date, $end_date){
        new self($start_date, $end_date);
        $r  = Transaction::with('client')->where(['type'=>'deposit'])->whereBetween('created_at',[self::$start_date, self::$end_date])->get();
        return $r;
    }
    public static function withdrawal($start_date, $end_date){
        new self($start_date, $end_date);
        $r  = Transaction::with('client')->where(['type'=>'withdrawal'])->whereBetween('created_at',[self::$start_date, self::$end_date])->get();
        return $r;
    }
}
