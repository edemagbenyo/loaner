<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationReport extends Model implements Report
{
    

    private static $start_date, $end_date;

    public function __construct($start_date, $end_date){
        self::$start_date = $start_date;
        self::$end_date = $end_date;
    }
    public static function periodic($start_date, $end_date){
        new self($start_date, $end_date);
        return Client::with('register')->whereBetween('created_at',[self::$start_date, self::$end_date])->get();
    }
}
