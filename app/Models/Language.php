<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
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

    public function isRegional(): bool
    {
        return $this->type === 'regional';
    }

    public function isEnglish(): bool
    {
        return $this->type === 'english';
    }
}
