@extends('layouts.app')

@section('title', 'SOUND Group - The Ultimate Entertainment Hub')

@section('content')
<div class="main-wrapper">

    <!-- Hero Banner Section -->
    <section class="hero-banner">
        @if(!empty($settings['announcement']))
            <div class="hero-announcement">
                <span class="badge-new-flash">
                    <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    NEW
                </span>
                <span>{{ $settings['announcement'] }}</span>
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 2rem;">
            <div>
                <h1 class="hero-title">{{ $settings['hero_headline'] }}</h1>
                <p class="hero-desc">{{ $settings['hero_subheadline'] }}</p>

                <div class="hero-actions">
                    <a href="{{ route('music.index') }}" class="btn-primary" style="padding: 0.75rem 1.75rem; font-size: 0.95rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        Explore Music
                    </a>
                    <a href="{{ route('videos.index') }}" class="btn-secondary" style="padding: 0.75rem 1.65rem; font-size: 0.95rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                        Watch Videos
                    </a>
                    <a href="{{ route('categories.languages') }}" class="btn-secondary" style="padding: 0.75rem 1.65rem; font-size: 0.95rem;">
                        🌐 Regional & English Catalog
                    </a>
                </div>
            </div>

            <!-- Featured Quick Play Card in Hero -->
            @if($heroMusic)
                <div class="glass-panel" style="padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1.25rem; max-width: 380px; width: 100%;">
                    <img src="{{ $heroMusic->cover_image }}" alt="{{ $heroMusic->title }}" style="width: 70px; height: 70px; border-radius: 12px; object-fit: cover; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
                    <div style="flex: 1; overflow: hidden;">
                        <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                            <span class="badge-new-flash" style="font-size: 0.62rem; padding: 2px 6px;">NEW</span>
                            <span style="font-size: 0.72rem; color: #10b981; font-weight: 700; text-transform: uppercase;">Trending Now</span>
                        </div>
                        <div style="font-weight: 700; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff;">
                            {{ $heroMusic->title }}
                        </div>
                        <div style="font-size: 0.8rem; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $heroMusic->artist->name }}
                        </div>
                    </div>
                    <button type="button" class="ctrl-btn-play" style="width: 44px; height: 44px; flex-shrink: 0;" onclick="window.playTrack('{{ $heroMusic->audio_url }}', '{{ addslashes($heroMusic->title) }}', '{{ addslashes($heroMusic->artist->name) }}', '{{ $heroMusic->cover_image }}', '{{ route('music.show', $heroMusic->id) }}', {{ $heroMusic->id }})">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION 1: LATEST MUSIC (EXACTLY 5 LISTINGS WITH FLASHING NEW BADGE) -->
    <section style="margin-bottom: 3.5rem;">
        <div class="section-head">
            <div class="section-head-title">
                <div class="soundwave">
                    <div class="soundwave-bar"></div>
                    <div class="soundwave-bar"></div>
                    <div class="soundwave-bar"></div>
                    <div class="soundwave-bar"></div>
                    <div class="soundwave-bar"></div>
                </div>
                <div>
                    <h2>Latest Music</h2>
                    <p class="section-sub">Top 5 freshest tracks released on SOUND Group across Regional & English catalogs</p>
                </div>
            </div>
            <div class="section-action">
                <a href="{{ route('music.index') }}">
                    View All Music
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
        </div>

        <div class="five-grid">
            @forelse($latestMusic as $song)
                <div class="media-card" data-track-id="{{ $song->id }}" data-track-url="{{ $song->audio_url }}" data-track-title="{{ $song->title }}" data-track-artist="{{ $song->artist->name }}" data-track-cover="{{ $song->cover_image }}" data-track-link="{{ route('music.show', $song->id) }}">
                    <!-- Thumbnail with Flashing NEW Badge -->
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

                        <!-- Instant Play Button -->
                        <button type="button" class="play-overlay-btn" title="Play Now" onclick="window.playTrack('{{ $song->audio_url }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->artist->name) }}', '{{ $song->cover_image }}', '{{ route('music.show', $song->id) }}', {{ $song->id }})">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                            </svg>
                        </button>
                    </div>

                    <!-- Song Info -->
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
                <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: var(--text-muted);">
                    No music available at this time.
                </div>
            @endforelse
        </div>
    </section>

    <!-- SECTION 2: LATEST VIDEOS (EXACTLY 5 LISTINGS WITH FLASHING NEW BADGE) -->
    <section style="margin-bottom: 3.5rem;">
        <div class="section-head">
            <div class="section-head-title">
                <div class="brand-icon" style="width: 32px; height: 32px; background: linear-gradient(135deg, #f43f5e 0%, #ec4899 100%);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                </div>
                <div>
                    <h2>Latest Videos</h2>
                    <p class="section-sub">Top 5 newest music videos, live performances & visualizers in cinema quality</p>
                </div>
            </div>
            <div class="section-action">
                <a href="{{ route('videos.index') }}">
                    View All Videos
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
        </div>

        <div class="five-grid">
            @forelse($latestVideos as $video)
                <div class="media-card">
                    <!-- 16:9 Thumbnail with Flashing NEW Badge -->
                    <div class="media-thumb-wrap video-aspect">
                        <img src="{{ $video->thumbnail_image }}" alt="{{ $video->title }}" class="media-thumb" loading="lazy">
                        
                        @if($video->is_new)
                            <div class="badge-position">
                                <span class="badge-new-flash">
                                    <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                                    NEW
                                </span>
                            </div>
                        @endif

                        <span class="duration-tag">{{ $video->duration }}</span>

                        <a href="{{ route('videos.show', $video->id) }}" class="play-overlay-btn" title="Watch Video">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                            </svg>
                        </a>
                    </div>

                    <!-- Video Info -->
                    <div class="media-info">
                        <a href="{{ route('videos.show', $video->id) }}" class="media-title" title="{{ $video->title }}">
                            {{ $video->title }}
                        </a>
                        <a href="{{ route('categories.artists.show', $video->artist->id) }}" class="media-artist">
                            {{ $video->artist->name }}
                        </a>

                        <div style="display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 0.6rem;">
                            <span class="badge-tag {{ $video->language->isRegional() ? 'badge-regional' : 'badge-english' }}">
                                {{ $video->language->name }}
                            </span>
                            <span class="badge-tag" style="background: rgba(255,255,255,0.06); color: #cbd5e1;">
                                {{ $video->genre->name }}
                            </span>
                        </div>

                        <div class="media-meta-row">
                            <span>{{ number_format($video->views_count) }} views</span>
                            <div class="rating-stars" title="Rating: {{ $video->average_rating }} / 5">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <span>{{ $video->average_rating > 0 ? $video->average_rating : 'New' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: var(--text-muted);">
                    No videos available at this time.
                </div>
            @endforelse
        </div>
    </section>

    <!-- SECTION 3: BROWSE BY CATEGORIES (ALBUM, ARTIST, YEAR, GENRE, LANGUAGE) -->
    <section style="margin-bottom: 3.5rem;">
        <div class="section-head">
            <div>
                <h2>Explore by Category</h2>
                <p class="section-sub">Browse entertainment arranged by Album, Artist, Year, Genre, and Regional Languages</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem;">
            <!-- Category: Artists -->
            <a href="{{ route('categories.artists') }}" class="glass-panel" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: transform var(--transition-fast);">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    🎤
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 1.05rem; color: #fff;">Artists</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $stats['artist_count'] }} Iconic Performers</div>
                </div>
            </a>

            <!-- Category: Albums -->
            <a href="{{ route('categories.albums') }}" class="glass-panel" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: transform var(--transition-fast);">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); color: #a78bfa; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    💿
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 1.05rem; color: #fff;">Albums</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $stats['album_count'] }} Studio & Motion Soundtracks</div>
                </div>
            </a>

            <!-- Category: Genres -->
            <a href="{{ route('categories.genres') }}" class="glass-panel" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: transform var(--transition-fast);">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); color: #fbbf24; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    🎸
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 1.05rem; color: #fff;">Genres</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">Pop, Rock, Classical, Bollywood...</div>
                </div>
            </a>

            <!-- Category: Years -->
            <a href="{{ route('categories.years') }}" class="glass-panel" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: transform var(--transition-fast);">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(6, 182, 212, 0.2); color: #38bdf8; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    📅
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 1.05rem; color: #fff;">Years & Eras</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">Vintage Classics to 2026 Releases</div>
                </div>
            </a>

            <!-- Category: Regional Languages -->
            <a href="{{ route('categories.languages') }}" class="glass-panel" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: transform var(--transition-fast);">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(244, 63, 94, 0.2); color: #fb7185; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    🌐
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 1.05rem; color: #fff;">Regional & English</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $stats['language_count'] }} Languages Hosted</div>
                </div>
            </a>
        </div>
    </section>

    <!-- SECTION 4: INFORMATION ABOUT SOUND GROUP -->
    <section class="glass-panel" style="padding: 3rem; margin-bottom: 3.5rem;">
        <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 3rem; align-items: center;">
            <div>
                <!-- <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.82rem; font-weight: 700; color: #10b981; text-transform: uppercase; margin-bottom: 0.5rem;">
                    <span>★</span> Welcome to SOUND Group
                </div> -->
                <h2 style="font-size: 2.3rem; margin-bottom: 1.25rem;">{{ $settings['about_title'] }}</h2>
                <p style="color: var(--text-muted); line-height: 1.8; font-size: 1rem; margin-bottom: 1.5rem;">
                    {{ $settings['about_description'] }}
                </p>
                
                <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #e2e8f0; font-size: 0.9rem;">
                        <span style="color: #10b981;">✔</span> Lossless Audio Streaming
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #e2e8f0; font-size: 0.9rem;">
                        <span style="color: #10b981;">✔</span> 4K Ultra-HD Video Player
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #e2e8f0; font-size: 0.9rem;">
                        <span style="color: #10b981;">✔</span> Authentic User Reviews & Ratings
                    </div>
                </div>
            </div>

            <!-- Stats Highlight Box -->
            <div style="background: rgba(0,0,0,0.3); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 2rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 1.5rem; color: #fff;">Entertainment Portal Metrics</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div>
                        <div style="font-size: 2rem; font-weight: 900; color: #10b981;">{{ $stats['music_count'] }}+</div>
                        <div style="font-size: 0.82rem; color: var(--text-muted);">Songs & Tracks</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 900; color: #ec4899;">{{ $stats['video_count'] }}+</div>
                        <div style="font-size: 0.82rem; color: var(--text-muted);">Music Videos</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 900; color: #a78bfa;">{{ $stats['artist_count'] }}+</div>
                        <div style="font-size: 0.82rem; color: var(--text-muted);">Artists & Bands</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 900; color: #38bdf8;">{{ $stats['review_count'] }}+</div>
                        <div style="font-size: 0.82rem; color: var(--text-muted);">Community Reviews</div>
                    </div>
                </div>

                <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.08);">
                    <a href="{{ route('about') }}" class="btn-primary" style="width: 100%; justify-content: center;">
                        Learn More About SOUND Group
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
