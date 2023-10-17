<?php

namespace App\Models;

use App\Models\CoffeeShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name', 'prov_id'
    ];

    /**
     * Get all of the CoffeeShop for the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CoffeeShop(): HasMany
    {
        return $this->hasMany(CoffeeShop::class);
    }
}
