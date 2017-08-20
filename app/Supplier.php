<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
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
        return $this->hasMany('App\SupplierAccount','supplier_id');
    }

    public function percentPaid ()
    {
        $total = $this->hasMany('App\SupplierAccount','supplier_id')->where(['type'=>'c'])->sum('amount');
        $paid = $this->hasMany('App\SupplierAccount','supplier_id')->where(['type'=>'d'])->sum('amount');

        return number_format(($paid/$total) * 100 , 2)."%";
    }
    public function total ()
    {

        return $this->hasMany('App\SupplierAccount','supplier_id')->where(['type'=>'c'])->sum('amount');
    }
    public function paid ()
    {

        return $this->hasMany('App\SupplierAccount','supplier_id')->where(['type'=>'d'])->sum('amount');
    }

    public function balance()
    {
        $account = $this->hasMany('App\SupplierAccount','supplier_id');

        $paid = $account->where(['type'=>'d'])->sum('amount');
        $total = $this->hasMany('App\SupplierAccount','supplier_id')->where(['type'=>'c'])->sum('amount');
        $balance = $total - $paid;

        return number_format($balance);
    }

    public function lastPayment()
    {
        return $this->hasMany('App\SupplierAccount','supplier_id')->where(['type'=>'d'])->orderBy('created_at','desc')->first();
    }
}
