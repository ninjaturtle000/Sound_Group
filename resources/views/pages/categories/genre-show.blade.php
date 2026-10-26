@extends('layouts.app')

@section('title', $genre->name . ' - Genre Collection')

@section('content')
<div class="main-wrapper">

    <div style="margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color);">
        <div style="display: inline-block; padding: 4px 12px; border-radius: 9999px; background: {{ $genre->color }}33; color: {{ $genre->color }}; font-weight: 700; font-size: 0.82rem; margin-bottom: 0.75rem;">
            GENRE ARCHIVE
        </div>
        <h1 style="font-size: 2.8rem; margin-bottom: 0.5rem;">{{ $genre->name }}</h1>
        <p style="color: var(--text-muted); font-size: 1rem; max-width: 700px;">
            {{ $genre->description }}
        </p>
    </div>

    <!-- Music in this Genre -->
    <section style="margin-bottom: 3.5rem;">
        <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem;">Songs in {{ $genre->name }}</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.25rem;">
            @forelse($musics as $song)
                <div class="media-card" data-track-id="{{ $song->id }}" data-track-url="{{ $song->audio_url }}" data-track-title="{{ $song->title }}" data-track-artist="{{ $song->artist->name }}" data-track-cover="{{ $song->cover_image }}" data-track-link="{{ route('music.show', $song->id) }}">
                    <div class="media-thumb-wrap">
                        <img src="{{ $song->cover_image }}" alt="{{ $song->title }}" class="media-thumb">
                        @if($song->is_new)<div class="badge-position"><span class="badge-new-flash">NEW</span></div>@endif
                        <span class="duration-tag">{{ $song->duration }}</span>
                        <button type="button" class="play-overlay-btn" onclick="window.playTrack('{{ $song->audio_url }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->artist->name) }}', '{{ $song->cover_image }}', '{{ route('music.show', $song->id) }}', {{ $song->id }})">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </button>
                    </div>
                    <div class="media-info">
                        <a href="{{ route('music.show', $song->id) }}" class="media-title">{{ $song->title }}</a>
                        <div class="media-artist">{{ $song->artist->name }}</div>
                        <div class="media-meta-row">
                            <span class="badge-tag {{ $song->language->isRegional() ? 'badge-regional' : 'badge-english' }}">{{ $song->language->name }}</span>
                            <span style="color: #fbbf24;">★ {{ $song->average_rating }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div style="color: var(--text-muted);">No songs in this genre yet.</div>
            @endforelse
        </div>
    </section>

    <!-- Videos in this Genre -->
    <section>
        <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem;">Videos in {{ $genre->name }}</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            @forelse($videos as $vid)
                <div class="media-card">
                    <div class="media-thumb-wrap video-aspect">
                        <img src="{{ $vid->thumbnail_image }}" alt="{{ $vid->title }}" class="media-thumb">
                        @if($vid->is_new)<div class="badge-position"><span class="badge-new-flash">NEW</span></div>@endif
                        <span class="duration-tag">{{ $vid->duration }}</span>
                        <a href="{{ route('videos.show', $vid->id) }}" class="play-overlay-btn">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </a>
                    </div>
                    <div class="media-info">
                        <a href="{{ route('videos.show', $vid->id) }}" class="media-title">{{ $vid->title }}</a>
                        <div class="media-meta-row">
                            <span>{{ number_format($vid->views_count) }} views</span>
                            <span style="color: #fbbf24;">★ {{ $vid->average_rating }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div style="color: var(--text-muted);">No videos in this genre yet.</div>
            @endforelse
        </div>
    </section>

</div>
@endsection
