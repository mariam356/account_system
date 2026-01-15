<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class OperationType extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];

}
