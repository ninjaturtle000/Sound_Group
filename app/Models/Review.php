<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_type', // 'music' or 'video'
        'item_id',
        'rating',
        'review_text',
    ];

    protected $casts = [
        'rating' => 'integer',
        'item_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getItemAttribute()
    {
        if ($this->item_type === 'music') {
            return Music::find($this->item_id);
        }
        if ($this->item_type === 'video') {
            return Video::find($this->item_id);
        }
        return null;
    }
}
