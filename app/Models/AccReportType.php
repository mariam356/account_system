<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class AccReportType extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];
}
