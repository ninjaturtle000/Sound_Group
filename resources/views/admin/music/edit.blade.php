@extends('layouts.admin')

@section('title', 'Edit Music - ' . $music->title)

@section('content')
<div style="max-width: 850px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Edit Music Track</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Update metadata, audio file stream, lyrics, or new badge status.</p>
        </div>
        <a href="{{ route('admin.music.index') }}" class="btn-secondary">
            &larr; Back to Catalog
        </a>
    </div>

    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('admin.music.update', $music->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Song Title <span class="required-mark">*</span></label>
                <input type="text" name="title" value="{{ old('title', $music->title) }}" class="form-control" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Artist <span class="required-mark">*</span></label>
                    <select name="artist_id" class="form-control" required>
                        @foreach($artists as $art)
                            <option value="{{ $art->id }}" {{ old('artist_id', $music->artist_id) == $art->id ? 'selected' : '' }}>
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
                            <option value="{{ $alb->id }}" {{ old('album_id', $music->album_id) == $alb->id ? 'selected' : '' }}>
                                {{ $alb->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Genre <span class="required-mark">*</span></label>
                    <select name="genre_id" class="form-control" required>
                        @foreach($genres as $gen)
                            <option value="{{ $gen->id }}" {{ old('genre_id', $music->genre_id) == $gen->id ? 'selected' : '' }}>
                                {{ $gen->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Language <span class="required-mark">*</span></label>
                    <select name="language_id" class="form-control" required>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ old('language_id', $music->language_id) == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }} ({{ strtoupper($lang->type) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Release Year <span class="required-mark">*</span></label>
                    <select name="year_id" class="form-control" required>
                        @foreach($years as $yr)
                            <option value="{{ $yr->id }}" {{ old('year_id', $music->year_id) == $yr->id ? 'selected' : '' }}>
                                {{ $yr->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 180px 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $music->duration) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Audio Stream URL</label>
                    <input type="text" name="audio_url" value="{{ old('audio_url', $music->audio_url) }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Replace Audio File (Optional, max 100MB)</label>
                <input type="file" name="audio_file" class="form-control" accept="audio/*">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Cover Image URL</label>
                    <input type="text" name="cover_image" value="{{ old('cover_image', $music->cover_image) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Replace Cover Image (Optional)</label>
                    <input type="file" name="cover_file" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Track Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $music->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Lyrics</label>
                <textarea name="lyrics" rows="4" class="form-control">{{ old('lyrics', $music->lyrics) }}</textarea>
            </div>

            <div style="background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 10px; padding: 1rem; margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $music->is_new) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #f43f5e;">
                    <div>
                        <div style="font-weight: 700; color: #fff; font-size: 0.95rem;">
                            Flash "NEW" Badge on Home & Catalog Pages
                        </div>
                        <div style="font-size: 0.82rem; color: #fda4af;">
                            When enabled, the animated flashing badge will highlight this track.
                        </div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem;">
                Update Music Track
            </button>
        </form>
    </div>

</div>
@endsection
