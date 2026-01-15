<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $appends = [

        'bill_type_name',
        'supplier_name',
        'sale_representative_name',
        'customer_name'


    ];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bill_type(){
        return $this->belongsTo(BillType::class, 'bill_type_id');
    }

    public function getBillTypeNameAttribute()
    {
        return $this->bill_type->name ?? '';
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getSupplierNameAttribute()
    {
        return $this->supplier->name ?? '';
    }

    public function billDetails(){
        return $this->hasMany(BillDetail::class);
    }

    public function sale_representative(){
        return $this->belongsTo(SaleRepresentative::class, 'sale_representative_id');
    }

    public function getSaleRepresentativeNameAttribute()
    {
        return $this->sale_representative->name ?? '';
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->name ?? '';
    }

}
