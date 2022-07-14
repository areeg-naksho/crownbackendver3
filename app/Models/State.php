<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'country_id',
        'default_shipping',
        'extra_shipping',
        'status'
    ];
    public $timestamps = false;
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function profile(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
    public function checkout(): HasMany
    {
        return $this->hasMany(Checkout::class);
    }
}
