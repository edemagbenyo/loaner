<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected  $guarded = ['id'];

    /**
    * Loanee
    *
    **/
    public function loanee(){
        return $this->belongsTo('App\Client','client_id','clientid');
    }

    /**
    * Applicant
    *
    **/
    public function applicant(){
        $loan =  $this->belongsTo('App\Client','client_id','clientid');
        return $loan;
    }

    
    /**
    * Application
    *
    **/
    public function application(){
        return $this->belongsTo('App\Application','application_id','applicationid');
    }

    /**
     * Account
     *
     **/
     public function account(){
        return $this->belongsTo('App\Account','account_id','accountid');
     }
    /**
    * PercentagePaid
    *
    **/
    public function percentPaid(){
    
    }


   
}
