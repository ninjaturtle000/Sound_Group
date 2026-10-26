<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Video;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminVideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with(['artist', 'album', 'genre', 'language', 'year']);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('title', 'like', "%{$q}%")
                ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$q}%"));
        }

        if ($request->filled('is_new')) {
            $query->where('is_new', $request->is_new == '1');
        }

        $videos = $query->latest()->paginate(15)->withQueryString();

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();
        $years = Year::orderByDesc('year')->get();

        return view('admin.videos.create', compact('artists', 'albums', 'genres', 'languages', 'years'));
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
            'video_file' => 'nullable|file|mimes:mp4,mov,webm,avi|max:100000',
            'video_url' => 'nullable|string|max:1000',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'thumbnail_image' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'is_new' => 'nullable|boolean',
        ]);

        // Video URL or File
        $videoUrl = $request->video_url;
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $videoUrl = '/storage/' . $path;
        }

        if (empty($videoUrl)) {
            return back()->withErrors(['video_url' => 'Please provide a video file URL / embed link or upload a video file.'])->withInput();
        }

        // Thumbnail Image or File
        $thumbnailImage = $request->thumbnail_image;
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('thumbnails', 'public');
            $thumbnailImage = '/storage/' . $path;
        }
        if (empty($thumbnailImage)) {
            $thumbnailImage = 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=600&auto=format&fit=crop&q=80';
        }

        $video = Video::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'artist_id' => $validated['artist_id'],
            'album_id' => $validated['album_id'] ?? null,
            'genre_id' => $validated['genre_id'],
            'language_id' => $validated['language_id'],
            'year_id' => $validated['year_id'],
            'duration' => $validated['duration'] ?: '4:00',
            'video_url' => $videoUrl,
            'thumbnail_image' => $thumbnailImage,
            'description' => $validated['description'] ?? null,
            'is_new' => $request->boolean('is_new', true),
        ]);

        return redirect()->route('admin.videos.index')->with('success', "Video '{$video->title}' added successfully!");
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();
        $years = Year::orderByDesc('year')->get();

        return view('admin.videos.edit', compact('video', 'artists', 'albums', 'genres', 'languages', 'years'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'year_id' => 'required|exists:years,id',
            'duration' => 'nullable|string|max:20',
            'video_file' => 'nullable|file|mimes:mp4,mov,webm,avi|max:100000',
            'video_url' => 'nullable|string|max:1000',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'thumbnail_image' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'is_new' => 'nullable|boolean',
        ]);

        $videoUrl = $video->video_url;
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $videoUrl = '/storage/' . $path;
        } elseif ($request->filled('video_url')) {
            $videoUrl = $request->video_url;
        }

        $thumbnailImage = $video->thumbnail_image;
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('thumbnails', 'public');
            $thumbnailImage = '/storage/' . $path;
        } elseif ($request->filled('thumbnail_image')) {
            $thumbnailImage = $request->thumbnail_image;
        }

        $video->update([
            'title' => $validated['title'],
            'artist_id' => $validated['artist_id'],
            'album_id' => $validated['album_id'] ?? null,
            'genre_id' => $validated['genre_id'],
            'language_id' => $validated['language_id'],
            'year_id' => $validated['year_id'],
            'duration' => $validated['duration'] ?: $video->duration,
            'video_url' => $videoUrl,
            'thumbnail_image' => $thumbnailImage,
            'description' => $validated['description'] ?? null,
            'is_new' => $request->boolean('is_new'),
        ]);

        return redirect()->route('admin.videos.index')->with('success', "Video '{$video->title}' updated successfully!");
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $title = $video->title;
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', "Video file '{$title}' deleted successfully.");
    }

    public function toggleNew($id)
    {
        $video = Video::findOrFail($id);
        $video->is_new = !$video->is_new;
        $video->save();

        $status = $video->is_new ? 'marked as NEW (flashing badge active)' : 'unmarked from NEW';
        return back()->with('success', "Video '{$video->title}' {$status}.");
    }
}
