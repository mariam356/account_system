<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];

    public $appends = [
        'background_color_row',
        'class_color_row',




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
}
