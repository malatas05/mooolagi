<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'price',
    'request_type',
    'is_active',
];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function getRouteKeyName(): string
{
    return 'slug';
}

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }
    public function templateSections(): HasMany
    {
    return $this->hasMany(TemplateSection::class)->orderBy('sort_order');
    }
    public function customRequests(): HasMany
    {
    return $this->hasMany(CustomRequest::class);
    }
    public function getFormattedPriceAttribute(): ?string
    {
    if (is_null($this->price)) {
        return null;
    }

    return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }
}