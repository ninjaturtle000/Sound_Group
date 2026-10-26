<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Video;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with(['artist', 'album', 'genre', 'language', 'year']);

        // Search Query
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

        // Filters
        if ($request->filled('artist')) {
            $query->where('artist_id', $request->artist);
        }

        if ($request->filled('album')) {
            $query->where('album_id', $request->album);
        }

        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        if ($request->filled('language')) {
            $query->where('language_id', $request->language);
        }

        if ($request->filled('language_type')) {
            $type = $request->language_type;
            $query->whereHas('language', fn($l) => $l->where('type', $type));
        }

        if ($request->filled('year')) {
            $query->where('year_id', $request->year);
        }

        if ($request->filled('is_new')) {
            $query->where('is_new', true);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'oldest' => $query->oldest(),
            'title_asc' => $query->orderBy('title', 'asc'),
            'title_desc' => $query->orderBy('title', 'desc'),
            'views' => $query->orderByDesc('views_count'),
            default => $query->orderByDesc('is_new')->latest(),
        };

        $videos = $query->paginate(12)->withQueryString();

        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();
        $years = Year::orderByDesc('year')->get();

        return view('pages.videos.index', compact(
            'videos',
            'artists',
            'albums',
            'genres',
            'languages',
            'years'
        ));
    }

    public function show($id)
    {
        $video = Video::with(['artist', 'album', 'genre', 'language', 'year', 'reviews.user'])
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();

        // Increment view count
        $video->increment('views_count');

        // Check if current user has an existing review
        $userReview = Auth::check() ? $video->getUserReview(Auth::id()) : null;

        // Related videos
        $relatedVideos = Video::with(['artist', 'album', 'genre'])
            ->where('id', '!=', $video->id)
            ->where(function ($q) use ($video) {
                $q->where('artist_id', $video->artist_id)
                  ->orWhere('genre_id', $video->genre_id)
                  ->orWhere('language_id', $video->language_id);
            })
            ->latest()
            ->take(6)
            ->get();

        return view('pages.videos.show', compact('video', 'userReview', 'relatedVideos'));
    }
}
