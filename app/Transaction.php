<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    //

    protected $guarded = ['id'];
    
    
    /**
     * Account
     *
     **/
     public function account(){
        return $this->belongsTo('App\Account','account_id','accountid');
     }

     /**
     * Today's transaction
     *
     **/
     public static function today(){
        return self::where('created_at',Carbon::today())->get();
     }

     /**
     * user
     *
     **/
     public function user(){
        return $this->hasOne('App\User','userid','user_id');
     }
}
