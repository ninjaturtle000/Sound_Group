@extends('layouts.app')

@section('title', 'Search Music & Videos - SOUND Group')

@section('content')
<div class="main-wrapper">

    <!-- Search Box Header -->
    <div class="glass-panel" style="padding: 2.5rem; margin-bottom: 2.5rem; background: radial-gradient(circle at 90% 10%, rgba(16, 185, 129, 0.12), transparent 40%), var(--bg-card);">
        <h1 style="font-size: 2.4rem; margin-bottom: 0.5rem;">Search SOUND Group Catalog</h1>
        <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.5rem;">
            Find any track, video, artist, album, or era across Regional and English media.
        </p>

        <form action="{{ route('search') }}" method="GET">
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 280px; position: relative;">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Type song title, artist, album name, or lyrics..." class="form-control" style="padding: 0.85rem 1rem 0.85rem 2.8rem; font-size: 1rem; border-radius: 9999px;" autofocus>
                    <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-dim);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </span>
                </div>

                <select name="genre" class="form-control" style="width: auto; max-width: 160px; border-radius: 9999px;">
                    <option value="">All Genres</option>
                    @foreach($allGenres as $g)
                        <option value="{{ $g->id }}" {{ request('genre') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                    @endforeach
                </select>

                <select name="language" class="form-control" style="width: auto; max-width: 160px; border-radius: 9999px;">
                    <option value="">All Languages</option>
                    @foreach($allLanguages as $l)
                        <option value="{{ $l->id }}" {{ request('language') == $l->id ? 'selected' : '' }}>{{ $l->name }}</option>
                    @endforeach
                </select>

                <select name="year" class="form-control" style="width: auto; max-width: 140px; border-radius: 9999px;">
                    <option value="">All Years</option>
                    @foreach($allYears as $y)
                        <option value="{{ $y->id }}" {{ request('year') == $y->id ? 'selected' : '' }}>{{ $y->year }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn-primary" style="padding: 0 1.75rem;">
                    Search
                </button>
            </div>

            <!-- Tab Pills -->
            <div style="display: flex; gap: 0.6rem; margin-top: 1.25rem;">
                <button type="submit" name="tab" value="all" class="pill-item {{ $tab === 'all' ? 'active' : '' }}" style="cursor: pointer; border: 1px solid var(--border-color);">
                    All Results
                </button>
                <button type="submit" name="tab" value="music" class="pill-item {{ $tab === 'music' ? 'active' : '' }}" style="cursor: pointer; border: 1px solid var(--border-color);">
                    🎵 Songs ({{ $musics->count() }})
                </button>
                <button type="submit" name="tab" value="videos" class="pill-item {{ $tab === 'videos' ? 'active' : '' }}" style="cursor: pointer; border: 1px solid var(--border-color);">
                    🎬 Videos ({{ $videos->count() }})
                </button>
                <button type="submit" name="tab" value="artists" class="pill-item {{ $tab === 'artists' ? 'active' : '' }}" style="cursor: pointer; border: 1px solid var(--border-color);">
                    🎤 Artists ({{ $artists->count() }})
                </button>
                <button type="submit" name="tab" value="albums" class="pill-item {{ $tab === 'albums' ? 'active' : '' }}" style="cursor: pointer; border: 1px solid var(--border-color);">
                    💿 Albums ({{ $albums->count() }})
                </button>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    @if($query === '' && !request('genre') && !request('language') && !request('year'))
        <div style="text-align: center; padding: 4rem; color: var(--text-muted);">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔎</div>
            <h3>Type a keyword above to start searching</h3>
            <p>Search across songs, videos, artists, albums, release years, and regional languages.</p>
        </div>
    @else
        <!-- Songs Results -->
        @if(in_array($tab, ['all', 'music']) && $musics->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 style="font-size: 1.6rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 8px;">
                    <span>🎵 Songs Matching Search</span>
                    <span style="font-size: 0.9rem; color: var(--text-dim); font-weight: normal;">({{ $musics->count() }})</span>
                </h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.25rem;">
                    @foreach($musics as $song)
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
                                <a href="{{ route('categories.artists.show', $song->artist->id) }}" class="media-artist">{{ $song->artist->name }}</a>
                                <div class="media-meta-row">
                                    <span class="badge-tag {{ $song->language->isRegional() ? 'badge-regional' : 'badge-english' }}">{{ $song->language->name }}</span>
                                    <span style="color: #fbbf24;">★ {{ $song->average_rating }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Video Results -->
        @if(in_array($tab, ['all', 'videos']) && $videos->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 style="font-size: 1.6rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 8px;">
                    <span>🎬 Videos Matching Search</span>
                    <span style="font-size: 0.9rem; color: var(--text-dim); font-weight: normal;">({{ $videos->count() }})</span>
                </h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                    @foreach($videos as $vid)
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
                                <div class="media-artist">{{ $vid->artist->name }}</div>
                                <div class="media-meta-row">
                                    <span>{{ number_format($vid->views_count) }} views</span>
                                    <span style="color: #fbbf24;">★ {{ $vid->average_rating }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Artists Results -->
        @if(in_array($tab, ['all', 'artists']) && $artists->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 style="font-size: 1.6rem; margin-bottom: 1.25rem;">🎤 Artists Found</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem;">
                    @foreach($artists as $art)
                        <a href="{{ route('categories.artists.show', $art->id) }}" class="glass-panel" style="padding: 1.5rem; text-align: center; display: block;">
                            <img src="{{ $art->image }}" alt="{{ $art->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 0.75rem; border: 2px solid var(--primary);">
                            <div style="font-weight: 700; color: #fff;">{{ $art->name }}</div>
                            <div style="font-size: 0.8rem; color: #34d399;">{{ $art->country }}</div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Albums Results -->
        @if(in_array($tab, ['all', 'albums']) && $albums->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 style="font-size: 1.6rem; margin-bottom: 1.25rem;">💿 Albums Found</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem;">
                    @foreach($albums as $alb)
                        <a href="{{ route('categories.albums.show', $alb->id) }}" class="media-card">
                            <div class="media-thumb-wrap">
                                <img src="{{ $alb->cover_image }}" alt="{{ $alb->title }}" class="media-thumb">
                            </div>
                            <div class="media-info">
                                <div class="media-title">{{ $alb->title }}</div>
                                <div class="media-artist">{{ $alb->artist->name }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        @if($musics->count() === 0 && $videos->count() === 0 && $artists->count() === 0 && $albums->count() === 0)
            <div style="text-align: center; padding: 4rem; color: var(--text-muted); background: var(--bg-card); border-radius: 16px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">😕</div>
                <h3>No results found for "{{ $query }}"</h3>
                <p>Try searching for a different artist, album, song title, or genre.</p>
            </div>
        @endif
    @endif

</div>
@endsection
