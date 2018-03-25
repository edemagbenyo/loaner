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
   
}
