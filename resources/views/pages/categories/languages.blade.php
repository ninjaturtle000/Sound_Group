@extends('layouts.app')

@section('title', 'Languages Catalog (Regional & English) - SOUND Group')

@section('content')
<div class="main-wrapper">

    <!-- Header -->
    <div style="margin-bottom: 2.5rem;">
        <div style="font-size: 0.85rem; color: #a78bfa; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            🌐 Global Linguistic Diversity
        </div>
        <h1 style="font-size: 2.8rem;">Regional & English Languages</h1>
        <p style="color: var(--text-muted); font-size: 1.05rem; max-width: 750px;">
            SOUND Group hosts songs and videos across authentic Regional languages and global English, preserving cultural roots while embracing international music.
        </p>
    </div>

    <!-- Section 1: English Languages -->
    <section style="margin-bottom: 3.5rem;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem;">
            <span class="badge-tag badge-english" style="font-size: 0.85rem; padding: 4px 12px;">English Category</span>
            <h2 style="font-size: 1.8rem; margin: 0;">Global English Releases</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem;">
            @foreach($englishLanguages as $el)
                <a href="{{ route('categories.languages.show', $el->id) }}" class="glass-panel" style="padding: 2rem; border-left: 4px solid #06b6d4; transition: all var(--transition-normal); display: block;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <h3 style="font-size: 1.5rem; color: #fff;">{{ $el->name }}</h3>
                        <span style="font-size: 0.8rem; font-weight: 700; background: rgba(6, 182, 212, 0.2); color: #38bdf8; padding: 2px 8px; border-radius: 4px;">{{ $el->code }}</span>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1.25rem;">
                        Mainstream pop, alternative rock, R&B grooves, and global cinema themes.
                    </p>
                    <div style="font-size: 0.82rem; color: #10b981; font-weight: 600;">
                        {{ $el->musics_count }} Songs &bull; {{ $el->videos_count }} Videos
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Section 2: Regional Languages -->
    <section>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem;">
            <span class="badge-tag badge-regional" style="font-size: 0.85rem; padding: 4px 12px;">Regional Category</span>
            <h2 style="font-size: 1.8rem; margin: 0;">Regional Language Vault</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem;">
            @foreach($regionalLanguages as $rl)
                <a href="{{ route('categories.languages.show', $rl->id) }}" class="glass-panel" style="padding: 2rem; border-left: 4px solid #8b5cf6; transition: all var(--transition-normal); display: block;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <h3 style="font-size: 1.5rem; color: #fff;">{{ $rl->name }}</h3>
                        <span style="font-size: 0.8rem; font-weight: 700; background: rgba(139, 92, 246, 0.2); color: #c4b5fd; padding: 2px 8px; border-radius: 4px;">{{ $rl->code }}</span>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1.25rem;">
                        Authentic regional acoustic traditions, folk rhythms, and film soundtracks.
                    </p>
                    <div style="font-size: 0.82rem; color: #a78bfa; font-weight: 600;">
                        {{ $rl->musics_count }} Songs &bull; {{ $rl->videos_count }} Videos
                    </div>
                </a>
            @endforeach
        </div>
    </section>

</div>
@endsection
