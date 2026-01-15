<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use OwenIt\Auditing\Contracts\Auditable;

class Branch extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','address'];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'image_path',



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

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
