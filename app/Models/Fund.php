<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class Fund extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'actions',
        'account_code'




    ];

    /**
     * The buttons in datatable
     */
    public function getActionsAttribute()
    {
        $actions = '';
        if (Gate::check('update fund')) {
        $actions .= '<a class="edit-table-row" id="' . $this->id . '" ><i class="la la-pencil-square success"></i></a>';
        }

        $actions .= '&nbsp';
        if (Gate::check('delete fund')) {
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

    public function account(){
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function getAccountCodeAttribute()
    {
        return $this->account->acc_code ?? '';
    }


}
