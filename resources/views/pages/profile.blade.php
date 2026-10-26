@extends('layouts.app')

@section('title', 'My Profile - SOUND Group')

@section('content')
<div class="main-wrapper" style="max-width: 960px;">

    <!-- Profile Header -->
    <div class="glass-panel" style="padding: 2rem 2.5rem; display: flex; align-items: center; gap: 2rem; margin-bottom: 2.5rem; flex-wrap: wrap;">
        <img src="{{ $user->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80' }}" alt="{{ $user->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary); box-shadow: 0 0 20px var(--primary-glow);">
        <div style="flex: 1;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.25rem;">
                <h1 style="font-size: 2.2rem; margin: 0;">{{ $user->name }}</h1>
                <span class="badge-tag" style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.8rem; font-weight: 700;">
                    {{ strtoupper($user->role) }}
                </span>
            </div>
            <div style="font-size: 0.95rem; color: #a78bfa; margin-bottom: 0.5rem;">@ {{ $user->userid }}</div>
            <div style="font-size: 0.85rem; color: var(--text-dim);">
                Member since {{ $user->created_at->format('M Y') }} &bull; {{ $reviews->total() }} Reviews & Ratings submitted
            </div>
        </div>
    </div>

    <!-- 2 Column Layout: Profile Update & Password Change -->
    <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 2rem; margin-bottom: 3rem;">
        
        <!-- Profile Details Form -->
        <div class="glass-panel" style="padding: 2rem;">
            <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; color: #fff;">Profile Details</h2>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">USERID (Read-Only Unique ID)</label>
                    <input type="text" value="{{ $user->userid }}" class="form-control" disabled style="opacity: 0.6; cursor: not-allowed;">
                </div>

                <div class="form-group">
                    <label class="form-label">Full Name <span class="required-mark">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email-id <span class="required-mark">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number <span class="required-mark">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Address <span class="required-mark">*</span></label>
                    <textarea name="address" rows="2" class="form-control" required>{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Avatar Image URL</label>
                    <input type="url" name="avatar" value="{{ old('avatar', $user->avatar) }}" class="form-control" placeholder="https://...">
                </div>

                <button type="submit" class="btn-primary" style="margin-top: 0.5rem;">
                    Save Profile Changes
                </button>
            </form>
        </div>

        <!-- Password Change Form -->
        <div class="glass-panel" style="padding: 2rem;">
            <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; color: #fff;">Change Password</h2>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Current Password <span class="required-mark">*</span></label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">New Password <span class="required-mark">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password <span class="required-mark">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn-secondary" style="margin-top: 0.5rem;">
                    Update Password
                </button>
            </form>
        </div>

    </div>

    <!-- My Reviews & Ratings Section -->
    <section class="glass-panel" style="padding: 2rem;">
        <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; color: #fff;">
            My Reviews & Ratings ({{ $reviews->total() }})
        </h2>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($reviews as $rev)
                @php $item = $rev->item; @endphp
                <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; display: flex; gap: 1.25rem; align-items: flex-start;">
                    @if($item)
                        <img src="{{ $rev->item_type === 'music' ? $item->cover_image : $item->thumbnail_image }}" style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover;">
                    @endif
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;">
                            <div>
                                <span class="badge-tag" style="background: rgba(255,255,255,0.08); color: #e2e8f0; font-size: 0.72rem; text-transform: uppercase;">
                                    {{ $rev->item_type }}
                                </span>
                                <a href="{{ $rev->item_type === 'music' ? route('music.show', $item->id ?? $rev->item_id) : route('videos.show', $item->id ?? $rev->item_id) }}" style="font-weight: 700; color: #fff; margin-left: 6px;">
                                    {{ $item ? $item->title : 'Unknown Item' }}
                                </a>
                            </div>

                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color: {{ $i <= $rev->rating ? '#fbbf24' : '#4b5563' }};">★</span>
                                @endfor
                                <span style="font-size: 0.82rem; font-weight: 700; color: #fbbf24; margin-left: 4px;">{{ $rev->rating }}.0</span>
                            </div>
                        </div>

                        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.6; margin-bottom: 0.75rem;">
                            {{ $rev->review_text }}
                        </p>

                        <div style="display: flex; align-items: center; justify-content: space-between; font-size: 0.75rem; color: var(--text-dim);">
                            <span>Submitted {{ $rev->created_at->diffForHumans() }}</span>

                            <div style="display: flex; gap: 0.75rem;">
                                <a href="{{ $rev->item_type === 'music' ? route('music.show', $rev->item_id) : route('videos.show', $rev->item_id) }}#reviews" style="color: #38bdf8; font-weight: 600;">
                                    ✏️ Modify
                                </a>
                                <form action="{{ route('reviews.destroy', $rev->id) }}" method="POST" onsubmit="return confirm('Delete this review?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #f43f5e; font-size: 0.75rem; cursor: pointer; font-weight: 600;">
                                    🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 2.5rem; color: var(--text-dim);">
                    You haven't submitted any reviews or ratings yet. Explore our <a href="{{ route('music.index') }}" style="color: var(--primary);">Music</a> or <a href="{{ route('videos.index') }}" style="color: var(--primary);">Videos</a> to start reviewing!
                </div>
            @endforelse
        </div>

        <div style="display: flex; justify-content: center; margin-top: 1.5rem;">
            {{ $reviews->links() }}
        </div>
    </section>

</div>
@endsection
