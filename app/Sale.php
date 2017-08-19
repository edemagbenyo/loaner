<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
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
    protected $table =  'sales';
    protected $guarded = ['id','measure'];

    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }
}
