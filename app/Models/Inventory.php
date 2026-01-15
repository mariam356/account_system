<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

protected $guarded = [];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'product_name',
        'product_unit_name',
        'movement_type_name'


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

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getProductNameAttribute()
    {
        return $this->product->name ?? '';
    }

    public function getProductUnitNameAttribute()
    {
        return $this->product->unit->name ?? '';
    }

    public function movement_type(){
        return $this->belongsTo(MovementType::class, 'movement_type_id');
    }

    public function getMovementTypeNameAttribute()
    {
        return $this->movement_type->name ?? '';
    }



}
