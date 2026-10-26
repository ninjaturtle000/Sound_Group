@extends('layouts.app')

@section('title', 'Release Years & Eras - SOUND Group')

@section('content')
<div class="main-wrapper">
    <div style="margin-bottom: 2rem;">
        <div style="font-size: 0.85rem; color: #38bdf8; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            📅 Decades & Release Years
        </div>
        <h1 style="font-size: 2.6rem;">Timeline of Music & Videos</h1>
        <p style="color: var(--text-muted); font-size: 1rem;">
            Travel through eras from vintage classics to fresh 2026 releases.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        @foreach($years as $yr)
            <a href="{{ route('categories.years.show', $yr->year) }}" class="glass-panel" style="padding: 2rem 1.5rem; text-align: center; display: block; transition: all var(--transition-normal);">
                <div style="font-size: 2.5rem; font-weight: 900; color: #38bdf8; margin-bottom: 0.5rem; font-family: var(--font-heading);">
                    {{ $yr->year }}
                </div>
                <div style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                    {{ $yr->description }}
                </div>
                <div style="font-size: 0.75rem; color: #10b981; font-weight: 600;">
                    {{ $yr->musics_count }} Songs &bull; {{ $yr->videos_count }} Videos
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
