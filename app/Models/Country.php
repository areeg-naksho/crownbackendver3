<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'status'
    ];
    public $timestamps = false;
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
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
