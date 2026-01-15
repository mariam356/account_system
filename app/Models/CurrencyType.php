<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model implements TranslatableContract
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Astrotomic\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    public function currency(){
        return $this->hasMany(Currency::class);
    }

}
