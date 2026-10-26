@extends('layouts.app')

@section('title', 'Browse Music Videos - SOUND Group')

@section('content')
<div class="main-wrapper">

    <!-- Header -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #ec4899; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
            <span>🎬</span> Video Entertainment Vault
        </div>
        <h1 style="font-size: 2.6rem;">Watch Music Videos & Visualizers</h1>
        <p style="color: var(--text-muted); font-size: 1rem;">
            High-definition cinema cuts, stadium live performances, and studio recordings across Regional and English languages.
        </p>
    </div>

    <!-- Filter Form -->
    <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2.5rem;">
        <form action="{{ route('videos.index') }}" method="GET">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; align-items: flex-end;">
                
                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Search Keywords</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Video title, artist..." class="form-control" style="padding: 0.5rem 0.8rem;">
                </div>

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

                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Year</label>
                    <select name="year" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="">All Years</option>
                        @foreach($years as $yr)
                            <option value="{{ $yr->id }}" {{ request('year') == $yr->id ? 'selected' : '' }}>
                                {{ $yr->year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label" style="font-size: 0.8rem;">Sort By</label>
                    <select name="sort" class="form-control" style="padding: 0.5rem 0.8rem;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Releases</option>
                        <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Most Viewed</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>

                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn-primary" style="flex: 1; justify-content: center; padding: 0.55rem;">
                        Apply
                    </button>
                    <a href="{{ route('videos.index') }}" class="btn-secondary" style="padding: 0.55rem 0.85rem;" title="Reset Filters">
                        ↺
                    </a>
                </div>

            </div>

            <!-- Language Type Shortcuts -->
            <div style="display: flex; gap: 0.75rem; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06); align-items: center; flex-wrap: wrap;">
                <span style="font-size: 0.8rem; color: var(--text-dim);">Language Type:</span>
                <a href="{{ route('videos.index', array_merge(request()->except('language_type'), ['language_type' => ''])) }}" class="pill-item {{ !request('language_type') ? 'active' : '' }}">
                    All Videos
                </a>
                <a href="{{ route('videos.index', array_merge(request()->except('language_type'), ['language_type' => 'regional'])) }}" class="pill-item {{ request('language_type') == 'regional' ? 'active' : '' }}">
                    🌐 Regional Videos Only
                </a>
                <a href="{{ route('videos.index', array_merge(request()->except('language_type'), ['language_type' => 'english'])) }}" class="pill-item {{ request('language_type') == 'english' ? 'active' : '' }}">
                    🇺🇸 English Videos Only
                </a>

                <label style="margin-left: auto; display: flex; align-items: center; gap: 6px; font-size: 0.82rem; cursor: pointer; color: #f43f5e; font-weight: 700;">
                    <input type="checkbox" name="is_new" value="1" {{ request('is_new') ? 'checked' : '' }} onchange="this.form.submit()">
                    <span>Show Flashing "NEW" Additions Only</span>
                </label>
            </div>
        </form>
    </div>

    <!-- Video Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        @forelse($videos as $vid)
            <div class="media-card">
                <div class="media-thumb-wrap video-aspect">
                    <img src="{{ $vid->thumbnail_image }}" alt="{{ $vid->title }}" class="media-thumb" loading="lazy">
                    
                    @if($vid->is_new)
                        <div class="badge-position">
                            <span class="badge-new-flash">
                                <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                                NEW
                            </span>
                        </div>
                    @endif

                    <span class="duration-tag">{{ $vid->duration }}</span>

                    <a href="{{ route('videos.show', $vid->id) }}" class="play-overlay-btn" title="Watch Video">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </a>
                </div>

                <div class="media-info">
                    <a href="{{ route('videos.show', $vid->id) }}" class="media-title" title="{{ $vid->title }}">
                        {{ $vid->title }}
                    </a>
                    <a href="{{ route('categories.artists.show', $vid->artist->id) }}" class="media-artist">
                        {{ $vid->artist->name }}
                    </a>

                    <div style="display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 0.6rem;">
                        <span class="badge-tag {{ $vid->language->isRegional() ? 'badge-regional' : 'badge-english' }}">
                            {{ $vid->language->name }}
                        </span>
                        <span class="badge-tag" style="background: rgba(255,255,255,0.06); color: #cbd5e1;">
                            {{ $vid->genre->name }}
                        </span>
                    </div>

                    <div class="media-meta-row">
                        <span>{{ number_format($vid->views_count) }} views</span>
                        <div class="rating-stars" title="Rating: {{ $vid->average_rating }} / 5">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span>{{ $vid->average_rating > 0 ? $vid->average_rating : 'New' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; padding: 4rem; text-align: center; background: var(--bg-card); border-radius: 16px; border: 1px solid var(--border-color);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🎬</div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem;">No videos found matching your filters</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Try clearing your filters or selecting a different language or genre.</p>
                <a href="{{ route('videos.index') }}" class="btn-primary">View Full Video Library</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: center; margin-bottom: 3rem;">
        {{ $videos->links() }}
    </div>

</div>
@endsection
