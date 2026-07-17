<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_section_id',
        'label',
        'type',
        'quantity',
        'size_spec',
        'char_limit',
        'instructions',
        'sort_order',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(TemplateSection::class, 'template_section_id');
    }
}