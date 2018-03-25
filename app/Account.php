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
}
