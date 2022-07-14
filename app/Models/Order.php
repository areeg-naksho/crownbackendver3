<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        // 'profile_id',
        // 'shipping_company_id',
        'payment_method_id',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'currency',
        'order_status',
    ];
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'id', 'user_id');
    // }

    // public function profile(): BelongsTo
    // {
    //     return $this->belongsTo(Profile::class,'id','profile_id');
    // }



    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'id', 'payment_method_id');
    }

    // public function shippingCompany(): BelongsTo
    // {
    //     return $this->belongsTo(ShippingCompany::class, 'id', 'shipping_company_id');
    // }
    /**
     * Get all of the orderproduct for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderproduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function checkout(): HasOne
    {
        return $this->hasOne(Checkout::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }
}
