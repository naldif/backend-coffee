<?php

namespace App\Models;

use App\Models\Cities;
use App\Models\Menu;
use App\Models\User;
use App\Traits\HasSlug;
use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoffeeShop extends Model
{
    use HasFactory, HasSlug, HasScope;

    protected $fillable = [
        'name', 'slug', 'cities_id', 'description', 'image', 'user_id'
    ];

    /**
     * Get all of the menu for the CoffeeShop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the user that owns the CoffeeShop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cities that owns the CoffeeShop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cities(): BelongsTo
    {
        return $this->belongsTo(Cities::class);
    }

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($image) => asset('storage/coffeeshop/' . $image),
        );
    }
}
