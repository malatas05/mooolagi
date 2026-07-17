<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomRequest extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'delivery_email',
    'product_id',
    'status',
    'quantity',
    'payment_proof',
    'customer_notes',
    'admin_notes',
];

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Ditinjau',
            'reviewed' => 'Sedang Ditinjau',
            'quoted' => 'Menunggu Konfirmasi Harga',
            'confirmed' => 'Dikonfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-cocoa/10 text-cocoa-dark',
            'reviewed' => 'bg-sky/10 text-sky',
            'quoted' => 'bg-sunshine/20 text-cocoa-dark',
            'confirmed', 'completed' => 'bg-meadow/10 text-meadow-dark',
            'in_progress' => 'bg-bubblegum/10 text-bubblegum',
            'cancelled' => 'bg-red-100 text-red-600',
            default => 'bg-gray-100 text-gray-600',
        };
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function slotValues(): HasMany
    {
        return $this->hasMany(RequestSlotValue::class);
    }
}