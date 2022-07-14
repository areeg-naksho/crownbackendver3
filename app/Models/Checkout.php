<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'address2',
        'country_id',
        'state_id',
        'city_id',
        'zip_code',
        'po_box'
    ];


    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()

    {
        return $this->belongsTo(City::class);
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }
}
