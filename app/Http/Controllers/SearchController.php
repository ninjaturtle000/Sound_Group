<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Music;
use App\Models\Video;
use App\Models\Year;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->get('q', ''));
        $tab = $request->get('tab', 'all'); // 'all', 'music', 'videos', 'artists', 'albums'
        $genreId = $request->get('genre');
        $languageId = $request->get('language');
        $yearId = $request->get('year');

        $musics = collect();
        $videos = collect();
        $artists = collect();
        $albums = collect();

        if ($query !== '' || $genreId || $languageId || $yearId) {
            // Search Music
            if (in_array($tab, ['all', 'music'])) {
                $musicQuery = Music::with(['artist', 'album', 'genre', 'language', 'year']);
                if ($query !== '') {
                    $musicQuery->where(function ($sub) use ($query) {
                        $sub->where('title', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('album', fn($al) => $al->where('title', 'like', "%{$query}%"))
                            ->orWhereHas('genre', fn($g) => $g->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('language', fn($l) => $l->where('name', 'like', "%{$query}%"));
                    });
                }
                if ($genreId) $musicQuery->where('genre_id', $genreId);
                if ($languageId) $musicQuery->where('language_id', $languageId);
                if ($yearId) $musicQuery->where('year_id', $yearId);

                $musics = $musicQuery->latest()->take(20)->get();
            }

            // Search Videos
            if (in_array($tab, ['all', 'videos'])) {
                $videoQuery = Video::with(['artist', 'album', 'genre', 'language', 'year']);
                if ($query !== '') {
                    $videoQuery->where(function ($sub) use ($query) {
                        $sub->where('title', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('album', fn($al) => $al->where('title', 'like', "%{$query}%"))
                            ->orWhereHas('genre', fn($g) => $g->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('language', fn($l) => $l->where('name', 'like', "%{$query}%"));
                    });
                }
                if ($genreId) $videoQuery->where('genre_id', $genreId);
                if ($languageId) $videoQuery->where('language_id', $languageId);
                if ($yearId) $videoQuery->where('year_id', $yearId);

                $videos = $videoQuery->latest()->take(20)->get();
            }

            // Search Artists
            if (in_array($tab, ['all', 'artists']) && $query !== '') {
                $artists = Artist::withCount(['musics', 'videos'])
                    ->where('name', 'like', "%{$query}%")
                    ->orWhere('country', 'like', "%{$query}%")
                    ->take(12)
                    ->get();
            }

            // Search Albums
            if (in_array($tab, ['all', 'albums']) && $query !== '') {
                $albums = Album::with(['artist', 'year'])
                    ->where('title', 'like', "%{$query}%")
                    ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$query}%"))
                    ->take(12)
                    ->get();
            }
        }

        $allGenres = Genre::orderBy('name')->get();
        $allLanguages = Language::orderBy('name')->get();
        $allYears = Year::orderByDesc('year')->get();

        return view('pages.search', compact(
            'query',
            'tab',
            'musics',
            'videos',
            'artists',
            'albums',
            'allGenres',
            'allLanguages',
            'allYears'
        ));
    }
}
