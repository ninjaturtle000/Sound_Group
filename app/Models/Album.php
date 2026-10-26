<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'artist_id',
        'genre_id',
        'year_id',
        'language_id',
        'cover_image',
        'description',
        'release_year',
    ];

    protected static function booted()
    {
        static::creating(function ($album) {
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->title) . '-' . Str::random(5);
            }
        });
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function musics(): HasMany
    {
        return $this->hasMany(Music::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
