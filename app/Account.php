<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    //
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    /**
    * Get the loan of the user
    *
    **/
    public function loan(){
        return $this->hasOne('App\Loan','account_id','accountid')->whereIn('status',['oncourse','pending']);
    }

    /**
    * client 
    *
    **/
    public function client(){
        return $this->hasOne('App\Client','account_id','accountid');
    }

    /**
    * Return total loan taken
    *
    **/
    public function loanTaken(){
        return $this->hasMany('App\Application','account_id','accountid')->where('status','approved')->sum('amount');
    }



    /**
    * Return total loan paid
    *
    **/
    public function loanPaid(){
    
    }
}
