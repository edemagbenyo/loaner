<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
