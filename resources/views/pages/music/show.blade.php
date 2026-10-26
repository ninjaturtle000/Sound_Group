@extends('layouts.app')

@section('title', $music->title . ' by ' . $music->artist->name)
@section('meta_description', Str::limit($music->description, 150))

@section('content')
<div class="main-wrapper">

    <!-- Breadcrumb -->
    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--text-dim); margin-bottom: 1.5rem;">
        <a href="{{ route('home') }}">Home</a>
        <span>/</span>
        <a href="{{ route('music.index') }}">Music</a>
        <span>/</span>
        <span style="color: #ffffff;">{{ $music->title }}</span>
    </div>

    <!-- Song Detail Hero -->
    <div class="detail-hero-layout">
        <!-- Cover Art & Quick Actions -->
        <div>
            <div style="position: relative;">
                <img src="{{ $music->cover_image }}" alt="{{ $music->title }}" class="detail-cover-large">
                @if($music->is_new)
                    <div style="position: absolute; top: 16px; left: 16px;">
                        <span class="badge-new-flash" style="font-size: 0.78rem; padding: 4px 10px;">
                            <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            NEW ADDITION
                        </span>
                    </div>
                @endif
            </div>

            <!-- Big Play Button -->
            <button type="button" class="btn-primary" style="width: 100%; justify-content: center; margin-top: 1.25rem; padding: 0.85rem; font-size: 1rem;" onclick="window.playTrack('{{ $music->audio_url }}', '{{ addslashes($music->title) }}', '{{ addslashes($music->artist->name) }}', '{{ $music->cover_image }}', '{{ route('music.show', $music->id) }}', {{ $music->id }})">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
                Play Full Song
            </button>
        </div>

        <!-- Song Metadata -->
        <div style="display: flex; flex-direction: column;">
            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 0.75rem; flex-wrap: wrap;">
                <span class="badge-tag {{ $music->language->isRegional() ? 'badge-regional' : 'badge-english' }}" style="font-size: 0.8rem; padding: 3px 10px;">
                    {{ $music->language->name }} ({{ ucfirst($music->language->type) }})
                </span>
                <span class="badge-tag" style="background: rgba(255,255,255,0.08); color: #e2e8f0; font-size: 0.8rem; padding: 3px 10px;">
                    {{ $music->genre->name }}
                </span>
                <span style="font-size: 0.85rem; color: var(--text-dim);">Duration: {{ $music->duration }}</span>
                <span style="font-size: 0.85rem; color: var(--text-dim); margin-left: auto;">{{ number_format($music->plays_count) }} plays</span>
            </div>

            <h1 style="font-size: 2.8rem; line-height: 1.15; margin-bottom: 0.5rem;">{{ $music->title }}</h1>
            
            <div style="font-size: 1.25rem; color: var(--text-muted); margin-bottom: 1.5rem;">
                By <a href="{{ route('categories.artists.show', $music->artist->id) }}" style="color: #34d399; font-weight: 700;">{{ $music->artist->name }}</a>
                @if($music->album)
                    &bull; From Album <a href="{{ route('categories.albums.show', $music->album->id) }}" style="color: #38bdf8;">{{ $music->album->title }}</a>
                @endif
                &bull; Release Year <a href="{{ route('categories.years.show', $music->year->year) }}" style="color: #fbbf24;">{{ $music->year->year }}</a>
            </div>

            <!-- Rating Summary Bar -->
            <div class="glass-panel" style="padding: 1rem 1.25rem; display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem; background: rgba(255,255,255,0.03);">
                <div style="display: flex; align-items: baseline; gap: 6px;">
                    <span style="font-size: 2.2rem; font-weight: 900; color: #fbbf24;">{{ $music->average_rating }}</span>
                    <span style="color: var(--text-dim); font-size: 0.9rem;">/ 5</span>
                </div>
                <div>
                    <div class="rating-stars" style="font-size: 1.1rem; margin-bottom: 2px;">
                        @for($i = 1; $i <= 5; $i++)
                            <span style="color: {{ $i <= round($music->average_rating) ? '#fbbf24' : '#4b5563' }};">★</span>
                        @endfor
                    </div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">
                        Based on {{ $music->ratings_count }} {{ Str::plural('rating', $music->ratings_count) }}
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($music->description)
                <div style="margin-bottom: 1.5rem; color: #cbd5e1; line-height: 1.7; font-size: 0.98rem;">
                    {{ $music->description }}
                </div>
            @endif

            <!-- Lyrics Snippet / Section -->
            @if($music->lyrics)
                <div style="margin-top: auto;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.6rem; color: #fff;">Lyrics</h3>
                    <div style="background: rgba(0,0,0,0.3); border: 1px solid var(--border-color); border-radius: 10px; padding: 1.25rem; font-size: 0.92rem; color: #94a3b8; line-height: 1.8; max-height: 160px; overflow-y: auto; white-space: pre-line;">
                        {{ $music->lyrics }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- REVIEWS & RATINGS SECTION -->
    <section class="reviews-section" id="reviews">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
            <div>
                <h2 style="font-size: 1.8rem;">Listener Reviews & Ratings</h2>
                <p style="color: var(--text-muted); font-size: 0.92rem;">Share your review and rating for this track</p>
            </div>
            <span style="font-size: 0.9rem; color: var(--text-dim);">
                {{ $music->reviews->count() }} {{ Str::plural('Review', $music->reviews->count()) }}
            </span>
        </div>

        <!-- Add or Modify Review Form -->
        @auth
            <div class="review-form-box">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.75rem; color: #fff;">
                    {{ $userReview ? 'Modify Your Review & Rating' : 'Leave a Review & Rating' }}
                </h3>

                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_type" value="music">
                    <input type="hidden" name="item_id" value="{{ $music->id }}">

                    <!-- Star Selector with Alpine.js -->
                    <div class="form-group" x-data="{ rating: {{ $userReview ? $userReview->rating : 5 }} }">
                        <label class="form-label">
                            Your Star Rating <span class="required-mark">*</span>
                        </label>
                        <input type="hidden" name="rating" :value="rating">
                        
                        <div class="rating-select-group">
                            <template x-for="star in [1, 2, 3, 4, 5]">
                                <button type="button" class="star-input-btn" @click="rating = star" :style="star <= rating ? 'color: #fbbf24;' : 'color: #4b5563;'">
                                    ★
                                </button>
                            </template>
                            <span style="font-weight: 700; color: #fbbf24; margin-left: 0.5rem; font-size: 1rem;" x-text="rating + ' / 5 Stars'"></span>
                        </div>
                    </div>

                    <!-- Review Text Field -->
                    <div class="form-group">
                        <label class="form-label">
                            Your Review Feedback <span class="required-mark">*</span>
                        </label>
                        <textarea name="review_text" rows="3" class="form-control" placeholder="What do you think of this track's production, vocals, and composition?" required>{{ old('review_text', $userReview ? $userReview->review_text : '') }}</textarea>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <button type="submit" class="btn-primary">
                            {{ $userReview ? 'Update My Review' : 'Submit Review & Rating' }}
                        </button>

                        @if($userReview)
                            <form action="{{ route('reviews.destroy', $userReview->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your review?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-danger">
                                    Delete My Review
                                </button>
                            </form>
                        @endif
                    </div>
                </form>
            </div>
        @else
            <div class="glass-panel" style="padding: 1.5rem 2rem; margin-bottom: 2rem; text-align: center;">
                <p style="color: var(--text-muted); margin-bottom: 1rem;">
                    Sign in with your SOUND Group account to add or modify your reviews and ratings.
                </p>
                <div style="display: flex; gap: 0.75rem; justify-content: center;">
                    <a href="{{ route('login') }}" class="btn-primary">Sign In to Review</a>
                    <a href="{{ route('register') }}" class="btn-secondary">Create Account</a>
                </div>
            </div>
        @endauth

        <!-- Reviews List -->
        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($music->reviews as $rev)
                <div class="glass-panel" style="padding: 1.5rem; background: rgba(255,255,255,0.02);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <img src="{{ $rev->user->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80' }}" alt="{{ $rev->user->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <div style="font-weight: 700; color: #fff; font-size: 0.95rem;">
                                    {{ $rev->user->name }}
                                    <span style="font-size: 0.75rem; color: var(--text-dim); font-weight: normal;">(@ {{ $rev->user->userid }})</span>
                                </div>
                                <div style="font-size: 0.75rem; color: var(--text-dim);">
                                    {{ $rev->created_at->diffForHumans() }}
                                    @if($rev->created_at != $rev->updated_at)
                                        (edited)
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Star Rating -->
                        <div class="rating-stars" style="font-size: 1.1rem;">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= $rev->rating ? '#fbbf24' : '#4b5563' }};">★</span>
                            @endfor
                            <span style="font-size: 0.85rem; font-weight: 700; margin-left: 4px; color: #fbbf24;">{{ $rev->rating }}.0</span>
                        </div>
                    </div>

                    <p style="color: #e2e8f0; line-height: 1.6; font-size: 0.92rem;">
                        {{ $rev->review_text }}
                    </p>
                </div>
            @empty
                <div style="text-align: center; padding: 2rem; color: var(--text-dim);">
                    No reviews yet for this track. Be the first to share your opinion!
                </div>
            @endforelse
        </div>
    </section>

    <!-- Related Music -->
    @if($relatedMusic->count() > 0)
        <section style="margin-top: 3.5rem;">
            <h2 style="font-size: 1.6rem; margin-bottom: 1.25rem;">You Might Also Enjoy</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem;">
                @foreach($relatedMusic as $rel)
                    <div class="media-card" data-track-id="{{ $rel->id }}" data-track-url="{{ $rel->audio_url }}" data-track-title="{{ $rel->title }}" data-track-artist="{{ $rel->artist->name }}" data-track-cover="{{ $rel->cover_image }}" data-track-link="{{ route('music.show', $rel->id) }}">
                        <div class="media-thumb-wrap">
                            <img src="{{ $rel->cover_image }}" alt="{{ $rel->title }}" class="media-thumb">
                            @if($rel->is_new)
                                <div class="badge-position"><span class="badge-new-flash">NEW</span></div>
                            @endif
                            <button type="button" class="play-overlay-btn" onclick="window.playTrack('{{ $rel->audio_url }}', '{{ addslashes($rel->title) }}', '{{ addslashes($rel->artist->name) }}', '{{ $rel->cover_image }}', '{{ route('music.show', $rel->id) }}', {{ $rel->id }})">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            </button>
                        </div>
                        <div class="media-info">
                            <a href="{{ route('music.show', $rel->id) }}" class="media-title">{{ $rel->title }}</a>
                            <div class="media-artist">{{ $rel->artist->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection
