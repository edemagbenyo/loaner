<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Land extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected  $guarded = ['id','payment'];

    public function percentSold()
    {
        $land =$this->size;
        $sold = $this->hasMany('App\Sale','land_id')->sum('dimension');
        return number_format(($sold/$land) * 100 , 2)."%";
    }
}
