<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'description',
    ];

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
