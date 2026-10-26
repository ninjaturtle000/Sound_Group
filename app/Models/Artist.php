<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'bio',
        'image',
        'country',
    ];

    protected static function booted()
    {
        static::creating(function ($artist) {
            if (empty($artist->slug)) {
                $artist->slug = Str::slug($artist->name) . '-' . Str::random(5);
            }
        });
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
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
