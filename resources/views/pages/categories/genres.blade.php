@extends('layouts.app')

@section('title', 'Music & Video Genres - SOUND Group')

@section('content')
<div class="main-wrapper">
    <div style="margin-bottom: 2rem;">
        <div style="font-size: 0.85rem; color: #fbbf24; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            🎸 Sound Styles & Rhythms
        </div>
        <h1 style="font-size: 2.6rem;">Explore by Genre</h1>
        <p style="color: var(--text-muted); font-size: 1rem;">
            Pop, Rock, Classical, Hip Hop, Bollywood, Electronic, and Soul.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        @foreach($genres as $genre)
            <a href="{{ route('categories.genres.show', $genre->id) }}" class="glass-panel" style="padding: 2rem 1.5rem; border-top: 4px solid {{ $genre->color ?: '#10b981' }}; transition: all var(--transition-normal); display: block;">
                <h3 style="font-size: 1.35rem; color: #ffffff; margin-bottom: 0.5rem;">{{ $genre->name }}</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.25rem; line-height: 1.6;">
                    {{ $genre->description }}
                </p>
                <div style="font-size: 0.78rem; color: #34d399; font-weight: 600;">
                    {{ $genre->musics_count }} Songs &bull; {{ $genre->videos_count }} Videos
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
