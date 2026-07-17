<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestSlotValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_request_id',
        'template_slot_id',
        'instance_index',
        'value_text',
        'value_file_path',
    ];

    public function customRequest(): BelongsTo
    {
        return $this->belongsTo(CustomRequest::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(TemplateSlot::class, 'template_slot_id');
    }
}