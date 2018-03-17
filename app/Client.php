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
        return $this->belongsTo('App\Account','account_id','accountid');
    }

    public function total ()
    {

        return $this->hasMany('App\Account','client_id')->where(['type'=>'d'])->sum('amount');
    }
    public function paid ()
    {

        return $this->hasMany('App\Account','client_id')->where(['type'=>'c'])->sum('amount');
    }

    public function percentPaid ()
    {
        $total = $this->hasMany('App\Account','client_id')->where(['type'=>'d'])->sum('amount');
        $paid = $this->hasMany('App\Account','client_id')->where(['type'=>'c'])->sum('amount');
        if($total == 0){
            $total = 1;
        }
        return number_format(($paid/$total) * 100 , 2)."%";
    }
    public function balance()
    {
        $account = $this->hasMany('App\Account','client_id');

        $paid = $account->where(['type'=>'c'])->sum('amount');
        $total = $this->hasMany('App\Account','client_id')->where(['type'=>'d'])->sum('amount');
        $balance = $total - $paid;

        return number_format($balance);
    }

    public function lastPayment()
    {
        return $this->hasMany('App\Account','client_id')->where(['type'=>'c'])->orderBy('created_at','desc')->first();
    }
}
