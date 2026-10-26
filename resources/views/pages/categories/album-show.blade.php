@extends('layouts.app')

@section('title', $album->title . ' - Album Details')

@section('content')
<div class="main-wrapper">

    <div class="glass-panel" style="padding: 2.5rem; display: flex; align-items: center; gap: 2.5rem; margin-bottom: 3rem; flex-wrap: wrap;">
        <img src="{{ $album->cover_image }}" alt="{{ $album->title }}" style="width: 180px; height: 180px; border-radius: 16px; object-fit: cover; box-shadow: 0 10px 30px rgba(0,0,0,0.6); border: 1px solid var(--border-color);">
        <div>
            <div style="font-size: 0.82rem; font-weight: 700; color: #a78bfa; text-transform: uppercase; margin-bottom: 0.35rem;">Album / Soundtrack</div>
            <h1 style="font-size: 3rem; margin-bottom: 0.5rem;">{{ $album->title }}</h1>
            <div style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 0.85rem;">
                By <a href="{{ route('categories.artists.show', $album->artist->id) }}" style="color: #34d399; font-weight: 700;">{{ $album->artist->name }}</a>
                &bull; Released {{ $album->release_year }}
            </div>
            <p style="color: var(--text-muted); line-height: 1.6; max-width: 650px;">
                {{ $album->description }}
            </p>
        </div>
    </div>

    <!-- Tracks in this Album -->
    <section style="margin-bottom: 3.5rem;">
        <h2 style="font-size: 1.8rem; margin-bottom: 1.25rem;">Tracklist ({{ $musics->count() }} Songs)</h2>
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
            @forelse($musics as $idx => $song)
                <div class="glass-panel" style="padding: 0.85rem 1.25rem; display: flex; align-items: center; gap: 1.25rem; background: rgba(255,255,255,0.02);">
                    <span style="font-size: 1rem; font-weight: 700; color: var(--text-dim); width: 24px;">{{ $idx + 1 }}</span>
                    <img src="{{ $song->cover_image }}" alt="{{ $song->title }}" style="width: 44px; height: 44px; border-radius: 6px; object-fit: cover;">
                    <div style="flex: 1;">
                        <a href="{{ route('music.show', $song->id) }}" style="font-weight: 700; font-size: 0.95rem; color: #fff;">{{ $song->title }}</a>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $song->artist->name }}</div>
                    </div>
                    <span class="badge-tag {{ $song->language->isRegional() ? 'badge-regional' : 'badge-english' }}">{{ $song->language->name }}</span>
                    <span style="font-size: 0.82rem; color: var(--text-dim);">{{ $song->duration }}</span>
                    <button type="button" class="ctrl-btn-play" style="width: 36px; height: 36px;" onclick="window.playTrack('{{ $song->audio_url }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->artist->name) }}', '{{ $song->cover_image }}', '{{ route('music.show', $song->id) }}', {{ $song->id }})">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    </button>
                </div>
            @empty
                <div style="color: var(--text-muted);">No songs in this album yet.</div>
            @endforelse
        </div>
    </section>

</div>
@endsection
