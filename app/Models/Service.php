<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'price',
        'price_modifier',
        'is_active',
    ];

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
