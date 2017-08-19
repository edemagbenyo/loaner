<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
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

    public function account()
    {
        return $this->hasMany('App\ClientAccount','client_id')->orderBy('created_at','desc');
    }

    public function total ()
    {

        return $this->hasMany('App\ClientAccount','client_id')->where(['type'=>'d'])->groupBy('id')->sum('amount');
    }
    public function paid ()
    {

        return $this->hasMany('App\ClientAccount','client_id')->where(['type'=>'c'])->groupBy('id')->sum('amount');
    }

    public function percentPaid ()
    {
        $total = $this->hasMany('App\ClientAccount','client_id')->where(['type'=>'d'])->groupBy('id')->sum('amount');
        $paid = $this->hasMany('App\ClientAccount','client_id')->where(['type'=>'c'])->groupBy('id')->sum('amount');

        return number_format(($paid/$total) * 100 , 2)."%";
    }
    public function balance()
    {
        $account = $this->hasMany('App\ClientAccount','client_id');

        $paid = $account->where(['type'=>'c'])->groupBy('id')->sum('amount');
        $total = $this->hasMany('App\ClientAccount','client_id')->where(['type'=>'d'])->groupBy('id')->sum('amount');
        $balance = $total - $paid;
        setlocale(LC_MONETARY, 'en_US');

        return number_format($balance);
    }

    public function lastPayment()
    {
        return $this->hasMany('App\ClientAccount','client_id')->where(['type'=>'c'])->orderBy('created_at','desc')->first();
    }
}
