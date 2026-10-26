@extends('layouts.admin')

@section('title', 'Edit Video - ' . $video->title)

@section('content')
<div style="max-width: 850px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Edit Video File</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Update video details, streaming URL, thumbnail, or flashing new badge status.</p>
        </div>
        <a href="{{ route('admin.videos.index') }}" class="btn-secondary">
            &larr; Back to Library
        </a>
    </div>

    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Video Title <span class="required-mark">*</span></label>
                <input type="text" name="title" value="{{ old('title', $video->title) }}" class="form-control" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Artist <span class="required-mark">*</span></label>
                    <select name="artist_id" class="form-control" required>
                        @foreach($artists as $art)
                            <option value="{{ $art->id }}" {{ old('artist_id', $video->artist_id) == $art->id ? 'selected' : '' }}>
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
                            <option value="{{ $alb->id }}" {{ old('album_id', $video->album_id) == $alb->id ? 'selected' : '' }}>
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
                            <option value="{{ $gen->id }}" {{ old('genre_id', $video->genre_id) == $gen->id ? 'selected' : '' }}>
                                {{ $gen->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Language <span class="required-mark">*</span></label>
                    <select name="language_id" class="form-control" required>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ old('language_id', $video->language_id) == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }} ({{ strtoupper($lang->type) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Release Year <span class="required-mark">*</span></label>
                    <select name="year_id" class="form-control" required>
                        @foreach($years as $yr)
                            <option value="{{ $yr->id }}" {{ old('year_id', $video->year_id) == $yr->id ? 'selected' : '' }}>
                                {{ $yr->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 180px 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $video->duration) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Video Stream / Embed URL</label>
                    <input type="text" name="video_url" value="{{ old('video_url', $video->video_url) }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Replace Video File (Optional)</label>
                <input type="file" name="video_file" class="form-control" accept="video/*">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Thumbnail URL</label>
                    <input type="text" name="thumbnail_image" value="{{ old('thumbnail_image', $video->thumbnail_image) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Replace Thumbnail File (Optional)</label>
                    <input type="file" name="thumbnail_file" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $video->description) }}</textarea>
            </div>

            <div style="background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 10px; padding: 1rem; margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $video->is_new) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #f43f5e;">
                    <div>
                        <div style="font-weight: 700; color: #fff; font-size: 0.95rem;">
                            Flash "NEW" Badge on Home & Catalog Pages
                        </div>
                        <div style="font-size: 0.82rem; color: #fda4af;">
                            When enabled, the animated flashing badge will highlight this video.
                        </div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem;">
                Update Video File
            </button>
        </form>
    </div>

</div>
@endsection
