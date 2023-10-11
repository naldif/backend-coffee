<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Models\Category;
use App\Traits\HasScope;
use App\Models\CoffeeShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, HasSlug, HasScope;

    protected $fillable = [
        'name', 'category_id', 'image', 'price', 'slug'
    ];

    /**
     * Get the category that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the coffeshop that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coffeshop(): BelongsTo
    {
        return $this->belongsTo(CoffeeShop::class);
    }

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($image) => asset('storage/menu/' . $image),
        );
    }
}
