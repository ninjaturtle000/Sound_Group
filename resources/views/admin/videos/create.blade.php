@extends('layouts.admin')

@section('title', 'Add Video File - Admin')

@section('content')
<div style="max-width: 850px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Add Video File</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Upload or link a video file / stream / embed with complete categorization.</p>
        </div>
        <a href="{{ route('admin.videos.index') }}" class="btn-secondary">
            &larr; Back to Library
        </a>
    </div>

    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Video Title -->
            <div class="form-group">
                <label class="form-label">Video Title <span class="required-mark">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="e.g. Blinding Lights (Official 4K Music Video)" required>
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
                        <option value="">No Album / Single Video</option>
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

            <!-- Duration & Video File / URL -->
            <div style="display: grid; grid-template-columns: 180px 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Duration (e.g. 4:20)</label>
                    <input type="text" name="duration" value="{{ old('duration', '4:00') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Video Stream / Embed URL <span class="required-mark">*</span></label>
                    <input type="text" name="video_url" value="{{ old('video_url') }}" class="form-control" placeholder="https://example.com/video.mp4 or YouTube embed (or upload below)">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Or Upload Video File (.mp4, .webm, max 100MB)</label>
                <input type="file" name="video_file" class="form-control" accept="video/*">
            </div>

            <!-- Thumbnail URL / File -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Thumbnail Image URL</label>
                    <input type="text" name="thumbnail_image" value="{{ old('thumbnail_image') }}" class="form-control" placeholder="https://images.unsplash.com/...">
                </div>

                <div class="form-group">
                    <label class="form-label">Or Upload Thumbnail (.jpg, .png, .webp)</label>
                    <input type="file" name="thumbnail_file" class="form-control" accept="image/*">
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Video Description / Director's Notes</label>
                <textarea name="description" rows="3" class="form-control" placeholder="Cinematography details, director, behind the scenes...">{{ old('description') }}</textarea>
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
                            When enabled, a pulsating glowing "NEW" animated badge will appear on this video, highlighting it in the Latest 5 listings.
                        </div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem;">
                Save & Publish Video File
            </button>
        </form>
    </div>

</div>
@endsection
