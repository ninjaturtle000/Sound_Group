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

class CategoryController extends Controller
{
    // ==========================================
    // ARTISTS
    // ==========================================
    public function artists()
    {
        $artists = Artist::withCount(['musics', 'videos', 'albums'])
            ->orderBy('name')
            ->paginate(12);

        return view('pages.categories.artists', compact('artists'));
    }

    public function showArtist($id)
    {
        $artist = Artist::where('id', $id)->orWhere('slug', $id)->firstOrFail();
        $musics = Music::with(['album', 'genre', 'language', 'year'])
            ->where('artist_id', $artist->id)
            ->latest()
            ->get();
        $videos = Video::with(['album', 'genre', 'language', 'year'])
            ->where('artist_id', $artist->id)
            ->latest()
            ->get();
        $albums = Album::where('artist_id', $artist->id)->latest()->get();

        return view('pages.categories.artist-show', compact('artist', 'musics', 'videos', 'albums'));
    }

    // ==========================================
    // ALBUMS
    // ==========================================
    public function albums()
    {
        $albums = Album::with(['artist', 'genre', 'language', 'year'])
            ->withCount(['musics', 'videos'])
            ->latest()
            ->paginate(12);

        return view('pages.categories.albums', compact('albums'));
    }

    public function showAlbum($id)
    {
        $album = Album::with(['artist', 'genre', 'language', 'year'])
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();

        $musics = Music::with(['artist', 'genre', 'language', 'year'])
            ->where('album_id', $album->id)
            ->latest()
            ->get();
        $videos = Video::with(['artist', 'genre', 'language', 'year'])
            ->where('album_id', $album->id)
            ->latest()
            ->get();

        return view('pages.categories.album-show', compact('album', 'musics', 'videos'));
    }

    // ==========================================
    // GENRES
    // ==========================================
    public function genres()
    {
        $genres = Genre::withCount(['musics', 'videos', 'albums'])
            ->orderBy('name')
            ->get();

        return view('pages.categories.genres', compact('genres'));
    }

    public function showGenre($id)
    {
        $genre = Genre::where('id', $id)->orWhere('slug', $id)->firstOrFail();
        $musics = Music::with(['artist', 'album', 'language', 'year'])
            ->where('genre_id', $genre->id)
            ->latest()
            ->paginate(12);
        $videos = Video::with(['artist', 'album', 'language', 'year'])
            ->where('genre_id', $genre->id)
            ->latest()
            ->paginate(12);

        return view('pages.categories.genre-show', compact('genre', 'musics', 'videos'));
    }

    // ==========================================
    // YEARS
    // ==========================================
    public function years()
    {
        $years = Year::withCount(['musics', 'videos', 'albums'])
            ->orderByDesc('year')
            ->get();

        return view('pages.categories.years', compact('years'));
    }

    public function showYear($yearNumber)
    {
        $year = Year::where('year', $yearNumber)->orWhere('id', $yearNumber)->firstOrFail();
        $musics = Music::with(['artist', 'album', 'genre', 'language'])
            ->where('year_id', $year->id)
            ->latest()
            ->paginate(12);
        $videos = Video::with(['artist', 'album', 'genre', 'language'])
            ->where('year_id', $year->id)
            ->latest()
            ->paginate(12);

        return view('pages.categories.year-show', compact('year', 'musics', 'videos'));
    }

    // ==========================================
    // LANGUAGES (Regional & English)
    // ==========================================
    public function languages()
    {
        $englishLanguages = Language::where('type', 'english')
            ->withCount(['musics', 'videos'])
            ->get();
        $regionalLanguages = Language::where('type', 'regional')
            ->withCount(['musics', 'videos'])
            ->get();

        return view('pages.categories.languages', compact('englishLanguages', 'regionalLanguages'));
    }

    public function showLanguage($id)
    {
        $language = Language::where('id', $id)->orWhere('code', strtoupper($id))->firstOrFail();
        $musics = Music::with(['artist', 'album', 'genre', 'year'])
            ->where('language_id', $language->id)
            ->latest()
            ->paginate(12);
        $videos = Video::with(['artist', 'album', 'genre', 'year'])
            ->where('language_id', $language->id)
            ->latest()
            ->paginate(12);

        return view('pages.categories.language-show', compact('language', 'musics', 'videos'));
    }
}
