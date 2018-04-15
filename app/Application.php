<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
     protected  $guarded = ['id'];

     /**
     * Guarantors
     *
     **/
     public function guarantors(){
        return $this->hasMany('App\Guarantor','application_id','applicationid');
     }

     /**
     * applicant
     *
     **/
     public function applicant(){
        $loan = $this->belongsTo('App\Client','client_id','clientid');
        return $loan->fname. ' '.$loan->lname;
     }

     /**
     * Account
     *
     **/
     public function account(){
        return $this->belongsTo('App\Account','account_id','accountid');
     }
}
