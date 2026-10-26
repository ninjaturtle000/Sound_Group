@extends('layouts.app')

@section('title', 'Featured Artists - SOUND Group')

@section('content')
<div class="main-wrapper">
    <div style="margin-bottom: 2rem;">
        <div style="font-size: 0.85rem; color: #10b981; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            🎤 Vocalists, Bands & Composers
        </div>
        <h1 style="font-size: 2.6rem;">Featured Artists</h1>
        <p style="color: var(--text-muted); font-size: 1rem;">
            Explore legendary musicians and breakout performers across Regional and English catalogs.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        @foreach($artists as $artist)
            <a href="{{ route('categories.artists.show', $artist->id) }}" class="glass-panel" style="padding: 1.5rem; text-align: center; display: flex; flex-direction: column; align-items: center; transition: all var(--transition-normal);">
                <div style="width: 140px; height: 140px; border-radius: 50%; overflow: hidden; margin-bottom: 1.25rem; border: 3px solid rgba(16, 185, 129, 0.4); box-shadow: 0 8px 20px rgba(0,0,0,0.5);">
                    <img src="{{ $artist->image ?: 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=300&auto=format&fit=crop&q=80' }}" alt="{{ $artist->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.15rem; color: #ffffff; margin-bottom: 0.25rem;">{{ $artist->name }}</h3>
                <div style="font-size: 0.8rem; color: #34d399; margin-bottom: 0.5rem;">{{ $artist->country }}</div>
                <div style="font-size: 0.75rem; color: var(--text-dim);">
                    {{ $artist->musics_count }} Songs &bull; {{ $artist->videos_count }} Videos
                </div>
            </a>
        @endforeach
    </div>

    <div style="display: flex; justify-content: center;">
        {{ $artists->links() }}
    </div>
</div>
@endsection
