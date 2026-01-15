<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BondDetail extends Model
{
    use SoftDeletes;
    public $appends = [
        'currency_name',
        'account_name',
        'account_number',


    ];
    protected $guarded=[];


    public function bond(){
        return $this->belongsTo(Bond::class, 'bond_id');
    }

    public function account(){
        return $this->belongsTo(Account::class, 'account_id');
    }


    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function getCurrencyNameAttribute()
    {
        return $this->currency->name ?? '';
    }
    public function getAccountNameAttribute()
    {
        return $this->account->name ?? '';
    }
    public function getAccountNumberAttribute()
    {
        return $this->account->acc_code ?? '';
    }


}
