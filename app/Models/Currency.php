<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class Currency extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];

    public $with=['currency_type'];
    public $appends = [
        'background_color_row',
        'class_color_row',
        'actions',
        'currency_type_name'

    ];

    /**
     * The buttons in datatable
     */
    public function getActionsAttribute()
    {
        $actions = '';
        if (Gate::check('update currency')) {
        $actions .= '<a class="edit-table-row" id="' . $this->id . '" ><i class="la la-pencil-square success"></i></a>';
        }

        $actions .= '&nbsp';
        if (Gate::check('delete currency')) {
        $actions .= '<a class="delete" id="' . $this->id . '"><i class="la la-trash danger"></i></a>';
        }

        return $actions;
    }

    public function getBackgroundColorRowAttribute()
    {
        return $this->status != 'نشط' ? 'background-color: #ff041508;' : '';
    }

    public function getClassColorRowAttribute()
    {
        return $this->status != 'نشط' ? 'tr-color-red' : '';
    }

    public function currency_type(){
        return $this->belongsTo(CurrencyType::class, 'currency_type_id');
    }

    public function getCurrencyTypeNameAttribute()
    {
        return $this->currency_type->name ?? '';
    }

}
