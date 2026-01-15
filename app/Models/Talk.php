<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Talk extends Model
{
    use SoftDeletes;
    protected $table = 'talks';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function getMessageAttribute($value)
    {
        // تحقق إذا كان هناك accessor يغير القيمة
        return $value; // يجب أن يرجع $value كما هي
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
