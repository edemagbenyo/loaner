<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    //
    protected $guarded = ['id'];

    /**
    * Applicant
    *
    **/
    public function applicant(){
        $loan =  $this->belongsTo('App\Client','client_id','clientid');
        return $loan;
    }

}
