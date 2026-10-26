@extends('layouts.app')

@section('title', 'Browse Music - SOUND Group')

@section('content')
<div class="main-wrapper">

    <!-- Header -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #10b981; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            <span>🎵</span> SOUND Group Music Catalog
        </div>
        <h1 style="font-size: 2.6rem;">Explore Music & Songs</h1>
        <p style="color: var(--text-muted); font-size: 1rem;">
            Discover regional and English tracks arranged by Artist, Album, Year, Genre, and Language.
        </p>
    </div>

    <!-- Filter Form -->
    <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2.5rem;">
        <form action="{{ route('music.index') }}" method="GET">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; align-items: flex-end;">
                
                <!-- Search Query -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Search Keywords</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Song title, lyrics..." class="form-control" style="padding: 0.5rem 0.8rem;">
                </div>

                <!-- Artist Filter -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Artist</label>
                    <select name="artist" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="">All Artists</option>
                        @foreach($artists as $art)
                            <option value="{{ $art->id }}" {{ request('artist') == $art->id ? 'selected' : '' }}>
                                {{ $art->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Album Filter -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Album</label>
                    <select name="album" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="">All Albums</option>
                        @foreach($albums as $alb)
                            <option value="{{ $alb->id }}" {{ request('album') == $alb->id ? 'selected' : '' }}>
                                {{ $alb->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Genre Filter -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Genre</label>
                    <select name="genre" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="">All Genres</option>
                        @foreach($genres as $gen)
                            <option value="{{ $gen->id }}" {{ request('genre') == $gen->id ? 'selected' : '' }}>
                                {{ $gen->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Language Filter -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Language</label>
                    <select name="language" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="">All Languages</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ request('language') == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }} ({{ strtoupper($lang->type) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Year Filter -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Release Year</label>
                    <select name="year" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="">All Years</option>
                        @foreach($years as $yr)
                            <option value="{{ $yr->id }}" {{ request('year') == $yr->id ? 'selected' : '' }}>
                                {{ $yr->year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Sort By</label>
                    <select name="sort" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Releases</option>
                        <option value="plays" {{ request('sort') == 'plays' ? 'selected' : '' }}>Most Played</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn-primary" style="flex: 1; justify-content: center; padding: 0.55rem;">
                        Apply
                    </button>
                    <a href="{{ route('music.index') }}" class="btn-secondary" style="padding: 0.55rem 0.85rem;" title="Reset Filters">
                        ↺
                    </a>
                </div>

            </div>

            <!-- Language Type Shortcut Buttons -->
            <div style="display: flex; gap: 0.75rem; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06); align-items: center; flex-wrap: wrap;">
                <span style="font-size: 0.8rem; color: var(--text-dim);">Language Type:</span>
                <a href="{{ route('music.index', array_merge(request()->except('language_type'), ['language_type' => ''])) }}" class="pill-item {{ !request('language_type') ? 'active' : '' }}">
                    All Songs
                </a>
                <a href="{{ route('music.index', array_merge(request()->except('language_type'), ['language_type' => 'regional'])) }}" class="pill-item {{ request('language_type') == 'regional' ? 'active' : '' }}">
                    🌐 Regional Languages Only
                </a>
                <a href="{{ route('music.index', array_merge(request()->except('language_type'), ['language_type' => 'english'])) }}" class="pill-item {{ request('language_type') == 'english' ? 'active' : '' }}">
                    🇺🇸 English Only
                </a>

                <label style="margin-left: auto; display: flex; align-items: center; gap: 6px; font-size: 0.82rem; cursor: pointer; color: #f43f5e; font-weight: 700;">
                    <input type="checkbox" name="is_new" value="1" {{ request('is_new') ? 'checked' : '' }} onchange="this.form.submit()">
                    <span>Show Flashing "NEW" Additions Only</span>
                </label>
            </div>
        </form>
    </div>

    <!-- Music Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        @forelse($musics as $song)
            <div class="media-card" data-track-id="{{ $song->id }}" data-track-url="{{ $song->audio_url }}" data-track-title="{{ $song->title }}" data-track-artist="{{ $song->artist->name }}" data-track-cover="{{ $song->cover_image }}" data-track-link="{{ route('music.show', $song->id) }}">
                <div class="media-thumb-wrap">
                    <img src="{{ $song->cover_image }}" alt="{{ $song->title }}" class="media-thumb" loading="lazy">
                    
                    @if($song->is_new)
                        <div class="badge-position">
                            <span class="badge-new-flash">
                                <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                                NEW
                            </span>
                        </div>
                    @endif

                    <span class="duration-tag">{{ $song->duration }}</span>

                    <button type="button" class="play-overlay-btn" title="Play Now" onclick="window.playTrack('{{ $song->audio_url }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->artist->name) }}', '{{ $song->cover_image }}', '{{ route('music.show', $song->id) }}', {{ $song->id }})">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </button>
                </div>

                <div class="media-info">
                    <a href="{{ route('music.show', $song->id) }}" class="media-title" title="{{ $song->title }}">
                        {{ $song->title }}
                    </a>
                    <a href="{{ route('categories.artists.show', $song->artist->id) }}" class="media-artist">
                        {{ $song->artist->name }}
                    </a>

                    <div style="display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 0.6rem;">
                        <span class="badge-tag {{ $song->language->isRegional() ? 'badge-regional' : 'badge-english' }}">
                            {{ $song->language->name }}
                        </span>
                        <span class="badge-tag" style="background: rgba(255,255,255,0.06); color: #cbd5e1;">
                            {{ $song->genre->name }}
                        </span>
                    </div>

                    <div class="media-meta-row">
                        <span>Year: <strong>{{ $song->year->year }}</strong></span>
                        <div class="rating-stars" title="Rating: {{ $song->average_rating }} / 5">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span>{{ $song->average_rating > 0 ? $song->average_rating : 'New' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; padding: 4rem; text-align: center; background: var(--bg-card); border-radius: 16px; border: 1px solid var(--border-color);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem;">No music found matching your filters</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Try adjusting your search criteria, language selection, or genre.</p>
                <a href="{{ route('music.index') }}" class="btn-primary">View Full Catalog</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: center; margin-bottom: 3rem;">
        {{ $musics->links() }}
    </div>

</div>
@endsection
