@extends('layouts.app')

@section('title', 'Albums Showcase - SOUND Group')

@section('content')
<div class="main-wrapper">
    <div style="margin-bottom: 2rem;">
        <div style="font-size: 0.85rem; color: #a78bfa; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            💿 Studio Albums & Soundtracks
        </div>
        <h1 style="font-size: 2.6rem;">Albums Directory</h1>
        <p style="color: var(--text-muted); font-size: 1rem;">
            Browse complete album collections and movie soundtracks.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        @foreach($albums as $album)
            <div class="media-card">
                <div class="media-thumb-wrap">
                    <img src="{{ $album->cover_image }}" alt="{{ $album->title }}" class="media-thumb">
                    <span class="duration-tag">{{ $album->release_year }}</span>
                    <a href="{{ route('categories.albums.show', $album->id) }}" class="play-overlay-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    </a>
                </div>
                <div class="media-info">
                    <a href="{{ route('categories.albums.show', $album->id) }}" class="media-title">{{ $album->title }}</a>
                    <a href="{{ route('categories.artists.show', $album->artist->id) }}" class="media-artist">{{ $album->artist->name }}</a>
                    <div class="media-meta-row">
                        <span>{{ $album->musics_count }} Tracks</span>
                        <span style="color: #38bdf8;">{{ $album->release_year }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div style="display: flex; justify-content: center;">
        {{ $albums->links() }}
    </div>
</div>
@endsection
