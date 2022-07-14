<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'transaction_status',
        'transaction_number',
        'payment_result'
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
