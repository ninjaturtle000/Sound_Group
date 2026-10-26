<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'artists'); // 'artists', 'albums', 'genres', 'years', 'languages'

        $artists = Artist::withCount(['musics', 'videos', 'albums'])->orderBy('name')->paginate(15);
        $albums = Album::with(['artist', 'year'])->withCount(['musics', 'videos'])->latest()->paginate(15);
        $genres = Genre::withCount(['musics', 'videos'])->orderBy('name')->get();
        $years = Year::withCount(['musics', 'videos'])->orderByDesc('year')->get();
        $languages = Language::withCount(['musics', 'videos'])->orderBy('name')->get();

        return view('admin.categories.index', compact('tab', 'artists', 'albums', 'genres', 'years', 'languages'));
    }

    // ==========================================
    // ARTIST ACTIONS
    // ==========================================
    public function storeArtist(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'image' => 'nullable|string|max:1000',
        ]);

        Artist::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'country' => $validated['country'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'image' => $validated['image'] ?: 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80',
        ]);

        return redirect()->route('admin.categories.index', ['tab' => 'artists'])->with('success', "Artist '{$validated['name']}' created successfully.");
    }

    public function deleteArtist($id)
    {
        $artist = Artist::findOrFail($id);
        $name = $artist->name;
        $artist->delete();

        return redirect()->route('admin.categories.index', ['tab' => 'artists'])->with('success', "Artist '{$name}' deleted successfully.");
    }

    // ==========================================
    // ALBUM ACTIONS
    // ==========================================
    public function storeAlbum(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer|min:1900|max:2099',
            'genre_id' => 'nullable|exists:genres,id',
            'language_id' => 'nullable|exists:languages,id',
            'cover_image' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
        ]);

        Album::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'artist_id' => $validated['artist_id'],
            'release_year' => $validated['release_year'] ?? date('Y'),
            'genre_id' => $validated['genre_id'] ?? null,
            'language_id' => $validated['language_id'] ?? null,
            'cover_image' => $validated['cover_image'] ?: 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=500&auto=format&fit=crop&q=80',
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index', ['tab' => 'albums'])->with('success', "Album '{$validated['title']}' created successfully.");
    }

    public function deleteAlbum($id)
    {
        $album = Album::findOrFail($id);
        $title = $album->title;
        $album->delete();

        return redirect()->route('admin.categories.index', ['tab' => 'albums'])->with('success', "Album '{$title}' deleted successfully.");
    }

    // ==========================================
    // GENRE ACTIONS
    // ==========================================
    public function storeGenre(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:genres,name',
            'color' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        Genre::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'color' => $validated['color'] ?: '#10B981',
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index', ['tab' => 'genres'])->with('success', "Genre '{$validated['name']}' created successfully.");
    }

    public function deleteGenre($id)
    {
        $genre = Genre::findOrFail($id);
        $name = $genre->name;
        $genre->delete();

        return redirect()->route('admin.categories.index', ['tab' => 'genres'])->with('success', "Genre '{$name}' deleted successfully.");
    }

    // ==========================================
    // YEAR ACTIONS
    // ==========================================
    public function storeYear(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2099|unique:years,year',
            'description' => 'nullable|string',
        ]);

        Year::create($validated);

        return redirect()->route('admin.categories.index', ['tab' => 'years'])->with('success', "Year '{$validated['year']}' added successfully.");
    }

    public function deleteYear($id)
    {
        $year = Year::findOrFail($id);
        $val = $year->year;
        $year->delete();

        return redirect()->route('admin.categories.index', ['tab' => 'years'])->with('success', "Year '{$val}' deleted successfully.");
    }

    // ==========================================
    // LANGUAGE ACTIONS (Regional & English)
    // ==========================================
    public function storeLanguage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:languages,name',
            'code' => 'required|string|max:10',
            'type' => 'required|in:english,regional',
        ]);

        Language::create([
            'name' => $validated['name'],
            'code' => strtoupper($validated['code']),
            'type' => $validated['type'],
        ]);

        return redirect()->route('admin.categories.index', ['tab' => 'languages'])->with('success', "Language '{$validated['name']}' ({$validated['type']}) added successfully.");
    }

    public function deleteLanguage($id)
    {
        $lang = Language::findOrFail($id);
        $name = $lang->name;
        $lang->delete();

        return redirect()->route('admin.categories.index', ['tab' => 'languages'])->with('success', "Language '{$name}' deleted successfully.");
    }
}
