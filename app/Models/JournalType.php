<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalType extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Astrotomic\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    public function journal()
    {
        return $this->hasMany(Journal::class);
    }

}
