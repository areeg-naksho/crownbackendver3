<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'image',
        'description_en',
        'description_ar',
        'price',
        'discount_price',
        'quantity',
        'featured',
        'category_id'
    ];
    protected $casts = [
        'image' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderproduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
