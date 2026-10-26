@extends('layouts.app')

@section('title', $video->title . ' - SOUND Group Video')
@section('meta_description', Str::limit($video->description, 150))

@section('content')
<div class="main-wrapper">

    <!-- Breadcrumb -->
    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--text-dim); margin-bottom: 1.5rem;">
        <a href="{{ route('home') }}">Home</a>
        <span>/</span>
        <a href="{{ route('videos.index') }}">Videos</a>
        <span>/</span>
        <span style="color: #ffffff;">{{ $video->title }}</span>
    </div>

    <!-- Video Theater Section -->
    <div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 2rem; margin-bottom: 3rem;">
        
        <!-- Left: Video Player & Info -->
        <div>
            <!-- Video Player Box -->
            <div class="video-player-container" style="position: relative;">
                @if(Str::contains($video->video_url, ['youtube.com', 'youtu.be']))
                    <iframe src="{{ $video->video_url }}" style="width: 100%; height: 100%; border: none;" allowfullscreen allow="autoplay; encrypted-media"></iframe>
                @else
                    <video controls poster="{{ $video->thumbnail_image }}" preload="metadata" style="width: 100%; height: 100%;">
                        <source src="{{ $video->video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>

            <!-- Video Header Info -->
            <div style="margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.6rem; flex-wrap: wrap;">
                    @if($video->is_new)
                        <span class="badge-new-flash">
                            <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            NEW RELEASE
                        </span>
                    @endif
                    <span class="badge-tag {{ $video->language->isRegional() ? 'badge-regional' : 'badge-english' }}">
                        {{ $video->language->name }} ({{ ucfirst($video->language->type) }})
                    </span>
                    <span class="badge-tag" style="background: rgba(255,255,255,0.06); color: #cbd5e1;">
                        {{ $video->genre->name }}
                    </span>
                    <span style="font-size: 0.85rem; color: var(--text-dim); margin-left: auto;">
                        {{ number_format($video->views_count) }} views &bull; {{ $video->duration }}
                    </span>
                </div>

                <h1 style="font-size: 2.2rem; line-height: 1.2; margin-bottom: 0.6rem;">{{ $video->title }}</h1>
                
                <div style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 1.25rem;">
                    Featuring <a href="{{ route('categories.artists.show', $video->artist->id) }}" style="color: #34d399; font-weight: 700;">{{ $video->artist->name }}</a>
                    @if($video->album)
                        &bull; Album: <a href="{{ route('categories.albums.show', $video->album->id) }}" style="color: #38bdf8;">{{ $video->album->title }}</a>
                    @endif
                    &bull; Year: <a href="{{ route('categories.years.show', $video->year->year) }}" style="color: #fbbf24;">{{ $video->year->year }}</a>
                </div>

                <!-- Rating Stats Bar -->
                <div class="glass-panel" style="padding: 0.85rem 1.25rem; display: flex; align-items: center; gap: 1.25rem; background: rgba(255,255,255,0.02); margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: baseline; gap: 4px;">
                        <span style="font-size: 1.8rem; font-weight: 900; color: #fbbf24;">{{ $video->average_rating }}</span>
                        <span style="color: var(--text-dim); font-size: 0.85rem;">/ 5</span>
                    </div>
                    <div>
                        <div class="rating-stars" style="font-size: 1rem;">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= round($video->average_rating) ? '#fbbf24' : '#4b5563' }};">★</span>
                            @endfor
                        </div>
                        <div style="font-size: 0.78rem; color: var(--text-muted);">
                            {{ $video->ratings_count }} {{ Str::plural('rating', $video->ratings_count) }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($video->description)
                    <div class="glass-panel" style="padding: 1.25rem 1.5rem; line-height: 1.7; color: #cbd5e1; font-size: 0.95rem;">
                        <h3 style="font-size: 1rem; color: #ffffff; margin-bottom: 0.5rem;">Video Overview</h3>
                        {{ $video->description }}
                    </div>
                @endif
            </div>

            <!-- REVIEWS & RATINGS SECTION -->
            <section class="reviews-section" style="margin-top: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                    <div>
                        <h2 style="font-size: 1.6rem;">Audience Reviews & Ratings</h2>
                        <p style="color: var(--text-muted); font-size: 0.88rem;">Add your review and rating for this video</p>
                    </div>
                    <span style="font-size: 0.85rem; color: var(--text-dim);">
                        {{ $video->reviews->count() }} {{ Str::plural('Review', $video->reviews->count()) }}
                    </span>
                </div>

                <!-- Add / Modify Review Form -->
                @auth
                    <div class="review-form-box">
                        <h3 style="font-size: 1.1rem; margin-bottom: 0.75rem; color: #fff;">
                            {{ $userReview ? 'Modify Your Video Review & Rating' : 'Leave a Video Review & Rating' }}
                        </h3>

                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="item_type" value="video">
                            <input type="hidden" name="item_id" value="{{ $video->id }}">

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
                                    <span style="font-weight: 700; color: #fbbf24; margin-left: 0.5rem;" x-text="rating + ' / 5 Stars'"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Your Review Feedback <span class="required-mark">*</span>
                                </label>
                                <textarea name="review_text" rows="3" class="form-control" placeholder="What are your thoughts on the cinematography, visual aesthetics, and music synchronization?" required>{{ old('review_text', $userReview ? $userReview->review_text : '') }}</textarea>
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
                                            Delete Review
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </form>
                    </div>
                @else
                    <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem; text-align: center;">
                        <p style="color: var(--text-muted); margin-bottom: 1rem;">
                            Sign in to SOUND Group to share your review and star rating for this video.
                        </p>
                        <div style="display: flex; gap: 0.75rem; justify-content: center;">
                            <a href="{{ route('login') }}" class="btn-primary">Sign In</a>
                            <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                        </div>
                    </div>
                @endauth

                <!-- Reviews List -->
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    @forelse($video->reviews as $rev)
                        <div class="glass-panel" style="padding: 1.25rem 1.5rem; background: rgba(255,255,255,0.02);">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ $rev->user->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80' }}" alt="{{ $rev->user->name }}" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                    <div>
                                        <div style="font-weight: 700; color: #fff; font-size: 0.92rem;">
                                            {{ $rev->user->name }}
                                            <span style="font-size: 0.75rem; color: var(--text-dim);">(@ {{ $rev->user->userid }})</span>
                                        </div>
                                        <div style="font-size: 0.72rem; color: var(--text-dim);">
                                            {{ $rev->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                <div class="rating-stars" style="font-size: 1rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span style="color: {{ $i <= $rev->rating ? '#fbbf24' : '#4b5563' }};">★</span>
                                    @endfor
                                    <span style="font-size: 0.85rem; font-weight: 700; margin-left: 4px; color: #fbbf24;">{{ $rev->rating }}.0</span>
                                </div>
                            </div>

                            <p style="color: #e2e8f0; line-height: 1.6; font-size: 0.9rem;">
                                {{ $rev->review_text }}
                            </p>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 2rem; color: var(--text-dim);">
                            No reviews yet for this video. Be the first to share your thoughts!
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Right: Related Videos Sidebar -->
        <div>
            <h3 style="font-size: 1.2rem; margin-bottom: 1rem; color: #fff;">Related Videos</h3>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse($relatedVideos as $relVid)
                    <a href="{{ route('videos.show', $relVid->id) }}" class="glass-panel" style="padding: 0.75rem; display: flex; gap: 0.85rem; align-items: center; transition: transform var(--transition-fast);">
                        <div style="position: relative; width: 110px; aspect-ratio: 16/9; border-radius: 8px; overflow: hidden; flex-shrink: 0;">
                            <img src="{{ $relVid->thumbnail_image }}" alt="{{ $relVid->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            <span class="duration-tag" style="font-size: 0.65rem; padding: 1px 4px;">{{ $relVid->duration }}</span>
                            @if($relVid->is_new)
                                <div style="position: absolute; top: 3px; left: 3px;">
                                    <span class="badge-new-flash" style="font-size: 0.55rem; padding: 1px 4px;">NEW</span>
                                </div>
                            @endif
                        </div>
                        <div style="overflow: hidden; flex: 1;">
                            <div style="font-weight: 700; font-size: 0.88rem; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $relVid->title }}
                            </div>
                            <div style="font-size: 0.78rem; color: var(--text-muted); margin-bottom: 4px;">
                                {{ $relVid->artist->name }}
                            </div>
                            <div style="font-size: 0.72rem; color: var(--text-dim);">
                                {{ number_format($relVid->views_count) }} views
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="color: var(--text-dim); font-size: 0.85rem;">No related videos found.</div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
