<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //

    protected $guarded = ['id'];


    public function caller()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
    * Customer information
    *
    **/
    public function customer(){
     return $this->belongsTo('App\Client','customer_id');
    }
}
