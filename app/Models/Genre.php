<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    protected static function booted()
    {
        static::creating(function ($genre) {
            if (empty($genre->slug)) {
                $genre->slug = Str::slug($genre->name);
            }
        });
    }

    public function musics(): HasMany
    {
        return $this->hasMany(Music::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
