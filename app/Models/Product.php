<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','address'];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'image_path',
        'category_name',
        'unit_name'



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

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? '';
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function getUnitNameAttribute()
    {
        return $this->unit->name ?? '';
    }

    public function inventory()
    {
        // تأكد أن اسم العمود في جدول inventory هو product_id
        return $this->hasMany(Inventory::class, 'product_id');
    }
}
