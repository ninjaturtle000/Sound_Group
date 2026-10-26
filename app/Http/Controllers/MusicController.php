<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Music;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        $query = Music::with(['artist', 'album', 'genre', 'language', 'year']);

        // Filter by Search Query
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$q}%"))
                    ->orWhereHas('album', fn($al) => $al->where('title', 'like', "%{$q}%"))
                    ->orWhereHas('genre', fn($g) => $g->where('name', 'like', "%{$q}%"))
                    ->orWhereHas('language', fn($l) => $l->where('name', 'like', "%{$q}%"));
            });
        }

        // Filter by Artist
        if ($request->filled('artist')) {
            $query->where('artist_id', $request->artist);
        }

        // Filter by Album
        if ($request->filled('album')) {
            $query->where('album_id', $request->album);
        }

        // Filter by Genre
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        // Filter by Language
        if ($request->filled('language')) {
            $query->where('language_id', $request->language);
        }

        // Filter by Language Type (Regional vs English)
        if ($request->filled('language_type')) {
            $type = $request->language_type;
            $query->whereHas('language', fn($l) => $l->where('type', $type));
        }

        // Filter by Year
        if ($request->filled('year')) {
            $query->where('year_id', $request->year);
        }

        // Filter by New Status
        if ($request->filled('is_new')) {
            $query->where('is_new', true);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'oldest' => $query->oldest(),
            'title_asc' => $query->orderBy('title', 'asc'),
            'title_desc' => $query->orderBy('title', 'desc'),
            'plays' => $query->orderByDesc('plays_count'),
            default => $query->orderByDesc('is_new')->latest(),
        };

        $musics = $query->paginate(12)->withQueryString();

        // Filter dropdown options
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();
        $years = Year::orderByDesc('year')->get();

        return view('pages.music.index', compact(
            'musics',
            'artists',
            'albums',
            'genres',
            'languages',
            'years'
        ));
    }

    public function show($id)
    {
        $music = Music::with(['artist', 'album', 'genre', 'language', 'year', 'reviews.user'])
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();

        // Increment play count
        $music->increment('plays_count');

        // Check if current user has an existing review
        $userReview = Auth::check() ? $music->getUserReview(Auth::id()) : null;

        // Related music from same artist or genre
        $relatedMusic = Music::with(['artist', 'album', 'genre'])
            ->where('id', '!=', $music->id)
            ->where(function ($q) use ($music) {
                $q->where('artist_id', $music->artist_id)
                  ->orWhere('genre_id', $music->genre_id)
                  ->orWhere('language_id', $music->language_id);
            })
            ->latest()
            ->take(6)
            ->get();

        return view('pages.music.show', compact('music', 'userReview', 'relatedMusic'));
    }
}
