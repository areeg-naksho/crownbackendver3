<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'address_title',
        'default_address',
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
        'po_box',
        'image'
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
        return $this->belongsTo(City::class, 'id', 'city_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
