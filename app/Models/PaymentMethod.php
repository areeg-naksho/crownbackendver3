<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'code',
        'merchant_email',
        'driver_name',
        'client_id',
        'client_secret',
        'sandbox_merchant_email',
        'sandbox_client_id',
        'sandbox_client_secret',
        'sandbox',
        'status'
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
