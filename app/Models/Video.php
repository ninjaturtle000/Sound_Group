<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'title',
        'slug',
        'artist_id',
        'album_id',
        'genre_id',
        'language_id',
        'year_id',
        'duration',
        'video_url',
        'thumbnail_image',
        'description',
        'is_new',
        'views_count',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'views_count' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title) . '-' . Str::random(5);
            }
        });
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'item_id')->where('item_type', 'video')->latest();
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function getRatingsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getUserReview(?int $userId = null): ?Review
    {
        if (!$userId) return null;
        return Review::where('item_type', 'video')
            ->where('item_id', $this->id)
            ->where('user_id', $userId)
            ->first();
    }
}
