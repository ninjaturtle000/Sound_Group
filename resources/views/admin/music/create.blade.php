@extends('layouts.admin')

@section('title', 'Add Music File - Admin')

@section('content')
<div style="max-width: 850px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Add Music File</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Upload or link an audio track with album, artist, year, genre, and language metadata.</p>
        </div>
        <a href="{{ route('admin.music.index') }}" class="btn-secondary">
            &larr; Back to Catalog
        </a>
    </div>

    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('admin.music.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Song Title -->
            <div class="form-group">
                <label class="form-label">Song Title <span class="required-mark">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="e.g. Starboy (Synthwave Remix)" required>
            </div>

            <!-- Artist & Album -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Artist <span class="required-mark">*</span></label>
                    <select name="artist_id" class="form-control" required>
                        <option value="">Select Artist</option>
                        @foreach($artists as $art)
                            <option value="{{ $art->id }}" {{ old('artist_id') == $art->id ? 'selected' : '' }}>
                                {{ $art->name }} ({{ $art->country }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Album (Optional)</label>
                    <select name="album_id" class="form-control">
                        <option value="">Single / No Album</option>
                        @foreach($albums as $alb)
                            <option value="{{ $alb->id }}" {{ old('album_id') == $alb->id ? 'selected' : '' }}>
                                {{ $alb->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Genre, Language, Year -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Genre <span class="required-mark">*</span></label>
                    <select name="genre_id" class="form-control" required>
                        <option value="">Select Genre</option>
                        @foreach($genres as $gen)
                            <option value="{{ $gen->id }}" {{ old('genre_id') == $gen->id ? 'selected' : '' }}>
                                {{ $gen->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Language <span class="required-mark">*</span></label>
                    <select name="language_id" class="form-control" required>
                        <option value="">Select Language</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ old('language_id') == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }} ({{ strtoupper($lang->type) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Release Year <span class="required-mark">*</span></label>
                    <select name="year_id" class="form-control" required>
                        <option value="">Select Year</option>
                        @foreach($years as $yr)
                            <option value="{{ $yr->id }}" {{ old('year_id') == $yr->id ? 'selected' : '' }}>
                                {{ $yr->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Duration & Audio File / Stream -->
            <div style="display: grid; grid-template-columns: 180px 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Duration (e.g. 3:45)</label>
                    <input type="text" name="duration" value="{{ old('duration', '3:30') }}" class="form-control" placeholder="3:30">
                </div>

                <div class="form-group">
                    <label class="form-label">Audio Stream URL <span class="required-mark">*</span></label>
                    <input type="text" name="audio_url" value="{{ old('audio_url') }}" class="form-control" placeholder="https://example.com/audio.mp3 (or upload below)">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Or Upload Audio File (.mp3, .wav, .ogg, .m4a, max 100MB)</label>
                <input type="file" name="audio_file" class="form-control" accept="audio/*">
            </div>

            <!-- Cover Image URL / File -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Cover Image URL</label>
                    <input type="text" name="cover_image" value="{{ old('cover_image') }}" class="form-control" placeholder="https://images.unsplash.com/...">
                </div>

                <div class="form-group">
                    <label class="form-label">Or Upload Cover Image (.jpg, .png, .webp)</label>
                    <input type="file" name="cover_file" class="form-control" accept="image/*">
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Track Description / Background Notes</label>
                <textarea name="description" rows="3" class="form-control" placeholder="Story behind the track, composer notes, production details...">{{ old('description') }}</textarea>
            </div>

            <!-- Lyrics -->
            <div class="form-group">
                <label class="form-label">Song Lyrics</label>
                <textarea name="lyrics" rows="4" class="form-control" placeholder="Verse 1, Chorus, Verse 2...">{{ old('lyrics') }}</textarea>
            </div>

            <!-- Flashing NEW Badge Status -->
            <div style="background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 10px; padding: 1rem; margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', true) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #f43f5e;">
                    <div>
                        <div style="font-weight: 700; color: #fff; font-size: 0.95rem;">
                            Flash "NEW" Badge on Home & Catalog Pages
                        </div>
                        <div style="font-size: 0.82rem; color: #fda4af;">
                            When enabled, a pulsating glowing "NEW" animated badge will appear on this track, highlighting it in the Latest 5 listings.
                        </div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem;">
                Save & Publish Music Track
            </button>
        </form>
    </div>

</div>
@endsection
