@extends('layouts.app')

@section('title', $artist->name . ' - Artist Profile')

@section('content')
<div class="main-wrapper">

    <!-- Artist Hero -->
    <div class="glass-panel" style="padding: 2.5rem; display: flex; align-items: center; gap: 2.5rem; margin-bottom: 3rem; flex-wrap: wrap;">
        <div style="width: 180px; height: 180px; border-radius: 50%; overflow: hidden; border: 4px solid var(--primary); box-shadow: 0 10px 30px var(--primary-glow); flex-shrink: 0;">
            <img src="{{ $artist->image ?: 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&auto=format&fit=crop&q=80' }}" alt="{{ $artist->name }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div style="flex: 1; min-width: 280px;">
            <div style="font-size: 0.82rem; font-weight: 700; color: #10b981; text-transform: uppercase; margin-bottom: 0.35rem;">Verified Artist</div>
            <h1 style="font-size: 3rem; margin-bottom: 0.5rem;">{{ $artist->name }}</h1>
            <div style="font-size: 0.95rem; color: #a78bfa; margin-bottom: 1rem;">From {{ $artist->country }}</div>
            <p style="color: var(--text-muted); line-height: 1.7; font-size: 0.95rem; max-width: 700px;">
                {{ $artist->bio }}
            </p>
        </div>
    </div>

    <!-- Artist Songs -->
    <section style="margin-bottom: 3.5rem;">
        <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem;">Songs by {{ $artist->name }}</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.25rem;">
            @forelse($musics as $song)
                <div class="media-card" data-track-id="{{ $song->id }}" data-track-url="{{ $song->audio_url }}" data-track-title="{{ $song->title }}" data-track-artist="{{ $artist->name }}" data-track-cover="{{ $song->cover_image }}" data-track-link="{{ route('music.show', $song->id) }}">
                    <div class="media-thumb-wrap">
                        <img src="{{ $song->cover_image }}" alt="{{ $song->title }}" class="media-thumb">
                        @if($song->is_new)
                            <div class="badge-position"><span class="badge-new-flash">NEW</span></div>
                        @endif
                        <span class="duration-tag">{{ $song->duration }}</span>
                        <button type="button" class="play-overlay-btn" onclick="window.playTrack('{{ $song->audio_url }}', '{{ addslashes($song->title) }}', '{{ addslashes($artist->name) }}', '{{ $song->cover_image }}', '{{ route('music.show', $song->id) }}', {{ $song->id }})">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </button>
                    </div>
                    <div class="media-info">
                        <a href="{{ route('music.show', $song->id) }}" class="media-title">{{ $song->title }}</a>
                        <div style="display: flex; gap: 4px; margin-bottom: 0.4rem;">
                            <span class="badge-tag {{ $song->language->isRegional() ? 'badge-regional' : 'badge-english' }}">{{ $song->language->name }}</span>
                            <span class="badge-tag" style="background: rgba(255,255,255,0.06); color: #cbd5e1;">{{ $song->genre->name }}</span>
                        </div>
                        <div class="media-meta-row">
                            <span>Year: {{ $song->year->year }}</span>
                            <span style="color: #fbbf24;">★ {{ $song->average_rating }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div style="color: var(--text-muted);">No songs listed for this artist yet.</div>
            @endforelse
        </div>
    </section>

    <!-- Artist Videos -->
    <section>
        <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem;">Music Videos by {{ $artist->name }}</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            @forelse($videos as $vid)
                <div class="media-card">
                    <div class="media-thumb-wrap video-aspect">
                        <img src="{{ $vid->thumbnail_image }}" alt="{{ $vid->title }}" class="media-thumb">
                        @if($vid->is_new)
                            <div class="badge-position"><span class="badge-new-flash">NEW</span></div>
                        @endif
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
                <div style="color: var(--text-muted);">No videos listed for this artist yet.</div>
            @endforelse
        </div>
    </section>

</div>
@endsection
