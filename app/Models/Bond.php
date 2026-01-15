<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bond extends Model
{
    use SoftDeletes;



    public $appends = [
        'background_color_row',
        'class_color_row',
        'fund_name',
        'bank_name'


    ];

    /**
     * The buttons in datatable
     */


    public function getBackgroundColorRowAttribute()
    {
        return $this->status != 'نشط' ? 'background-color: #ff041508;' : '';
    }

    public function getClassColorRowAttribute()
    {
        return $this->status != 'نشط' ? 'tr-color-red' : '';
    }



    public function fund(){
        return $this->belongsTo(Fund::class, 'fund_id');
    }

    public function getFundNameAttribute()
    {
        return $this->fund->name ?? '';
    }

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function getBankNameAttribute()
    {
        return $this->bank->name ?? '';
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
