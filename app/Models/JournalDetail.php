<?php

namespace App\Models;

use App\Http\Controllers\CustomerController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalDetail extends Model
{
    use SoftDeletes;

  protected $guarded=[];

    public $appends = [
        'currency_name',
        'account_name',
        'account_number',
        'date',
        'operation_type'

    ];

    public function journal(){
        return $this->belongsTo(Journal::class, 'journal_id');
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

    public function getDateAttribute()
    {
        return $this->journal->date ?? '';
    }

    public function getOperationTypeAttribute()
    {
        return $this->journal->operation_type->name ?? '';
    }
}
