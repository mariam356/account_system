<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'operation_type_name',
        'journal_type_name',


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

    public function journal_type(){
        return $this->belongsTo(JournalType::class, 'journal_type_id');
    }

    public function operation_type(){
        return $this->belongsTo(OperationType::class, 'operation_type_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getJournalTypeNameAttribute()
    {
        return $this->journal_type->name ?? '';
    }

    public function getOperationTypeNameAttribute()
    {
        return $this->operation_type->name ?? '';
    }

    public function journalDetails(){
        return $this->hasMany(JournalDetail::class);
    }


}
