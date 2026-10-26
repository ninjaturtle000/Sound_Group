<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Music;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminMusicController extends Controller
{
    public function index(Request $request)
    {
        $query = Music::with(['artist', 'album', 'genre', 'language', 'year']);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('title', 'like', "%{$q}%")
                ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$q}%"));
        }

        if ($request->filled('is_new')) {
            $query->where('is_new', $request->is_new == '1');
        }

        $musics = $query->latest()->paginate(15)->withQueryString();

        return view('admin.music.index', compact('musics'));
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();
        $years = Year::orderByDesc('year')->get();

        return view('admin.music.create', compact('artists', 'albums', 'genres', 'languages', 'years'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'year_id' => 'required|exists:years,id',
            'duration' => 'nullable|string|max:20',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:102400',
            'audio_url' => 'nullable|string|max:1000',
            'cover_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'is_new' => 'nullable|boolean',
        ]);

        // Audio URL or File
        $audioUrl = $request->audio_url;
        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('music', 'public');
            $audioUrl = '/storage/' . $path;
        }

        if (empty($audioUrl)) {
            return back()->withErrors(['audio_url' => 'Please provide an audio stream URL or upload an audio file.'])->withInput();
        }

        // Cover Image or File
        $coverImage = $request->cover_image;
        if ($request->hasFile('cover_file')) {
            $path = $request->file('cover_file')->store('covers', 'public');
            $coverImage = '/storage/' . $path;
        }
        if (empty($coverImage)) {
            $coverImage = 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80';
        }

        $music = Music::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'artist_id' => $validated['artist_id'],
            'album_id' => $validated['album_id'] ?? null,
            'genre_id' => $validated['genre_id'],
            'language_id' => $validated['language_id'],
            'year_id' => $validated['year_id'],
            'duration' => $validated['duration'] ?: '3:30',
            'audio_url' => $audioUrl,
            'cover_image' => $coverImage,
            'description' => $validated['description'] ?? null,
            'lyrics' => $validated['lyrics'] ?? null,
            'is_new' => $request->boolean('is_new', true),
        ]);

        return redirect()->route('admin.music.index')->with('success', "Music track '{$music->title}' added successfully!");
    }

    public function edit($id)
    {
        $music = Music::findOrFail($id);
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();
        $years = Year::orderByDesc('year')->get();

        return view('admin.music.edit', compact('music', 'artists', 'albums', 'genres', 'languages', 'years'));
    }

    public function update(Request $request, $id)
    {
        $music = Music::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'year_id' => 'required|exists:years,id',
            'duration' => 'nullable|string|max:20',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:102400',
            'audio_url' => 'nullable|string|max:1000',
            'cover_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'is_new' => 'nullable|boolean',
        ]);

        $audioUrl = $music->audio_url;
        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('music', 'public');
            $audioUrl = '/storage/' . $path;
        } elseif ($request->filled('audio_url')) {
            $audioUrl = $request->audio_url;
        }

        $coverImage = $music->cover_image;
        if ($request->hasFile('cover_file')) {
            $path = $request->file('cover_file')->store('covers', 'public');
            $coverImage = '/storage/' . $path;
        } elseif ($request->filled('cover_image')) {
            $coverImage = $request->cover_image;
        }

        $music->update([
            'title' => $validated['title'],
            'artist_id' => $validated['artist_id'],
            'album_id' => $validated['album_id'] ?? null,
            'genre_id' => $validated['genre_id'],
            'language_id' => $validated['language_id'],
            'year_id' => $validated['year_id'],
            'duration' => $validated['duration'] ?: $music->duration,
            'audio_url' => $audioUrl,
            'cover_image' => $coverImage,
            'description' => $validated['description'] ?? null,
            'lyrics' => $validated['lyrics'] ?? null,
            'is_new' => $request->boolean('is_new'),
        ]);

        return redirect()->route('admin.music.index')->with('success', "Music track '{$music->title}' updated successfully!");
    }

    public function destroy($id)
    {
        $music = Music::findOrFail($id);
        $title = $music->title;
        $music->delete();

        return redirect()->route('admin.music.index')->with('success', "Music file '{$title}' deleted successfully.");
    }

    public function toggleNew($id)
    {
        $music = Music::findOrFail($id);
        $music->is_new = !$music->is_new;
        $music->save();

        $status = $music->is_new ? 'marked as NEW (flashing badge active)' : 'unmarked from NEW';
        return back()->with('success', "Music '{$music->title}' {$status}.");
    }
}
