<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'subcategory_id', 'name', 'slug', 'description',
        'retail_price', 'wholesale_price', 'badge', 'cover_image',
        'sizes', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'retail_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'sizes' => 'array',
    ];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function templates(): HasMany
    {
        return $this->hasMany(ProductTemplate::class)->orderBy('sort_order');
    }

    public function priceFor(?User $user): float
    {
        return $user && $user->seesWholesale()
            ? (float) $this->wholesale_price
            : (float) $this->retail_price;
    }
}
