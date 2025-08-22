<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'full_name',
        'address',
        'phone',
        'note',
        'payment_method',
        'payment_channel', // ini WAJIB ADA
        'va_number',       // ini juga WAJIB ADA
        'total_price',
        'payment_proof',
        'status',
        'user_id',
    ];    

    public function items()
        {
            return $this->hasMany(TransactionItem::class);
        }

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
