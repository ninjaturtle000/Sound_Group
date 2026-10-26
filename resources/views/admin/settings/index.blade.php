@extends('layouts.admin')

@section('title', 'Manage Website Details & Backup - Admin')

@section('content')
<div style="max-width: 920px;">

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.2rem; margin: 0;">Manage Website Details & Information</h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
            Control the public brand identity, announcements, about text, contact information, and database backups.
        </p>
    </div>

    <!-- Database Backup Section -->
    <div class="glass-panel" style="padding: 2rem; margin-bottom: 2.5rem; border-top: 4px solid #10b981; background: radial-gradient(circle at 90% 10%, rgba(16, 185, 129, 0.1), transparent 40%), var(--bg-card);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.35rem;">
                    <span style="font-size: 1.2rem;">💾</span>
                    <h2 style="font-size: 1.35rem; margin: 0; color: #fff;">Database Backup (SQL Export)</h2>
                </div>
                <p style="color: var(--text-muted); font-size: 0.88rem; max-width: 520px; line-height: 1.6;">
                    Complete schema and table dump containing Users, Artists, Albums, Genres, Languages, Years, Music, Videos, and Reviews.
                </p>
                <div style="margin-top: 0.5rem; font-size: 0.82rem; color: #a78bfa;">
                    Current File: <strong>sound_group_backup.sql</strong> ({{ $backupSize }}) &bull; Last Generated: {{ $backupTime ?: 'Never' }}
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <form action="{{ route('admin.settings.export-backup') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        ⚡ Regenerate Backup
                    </button>
                </form>

                <a href="{{ route('admin.settings.download-backup') }}" class="btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Download SQL File
                </a>
            </div>
        </div>
    </div>

    <!-- Website Details Form -->
    <div class="glass-panel" style="padding: 2.5rem;">
        <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; color: #fff;">Public Information & Copy</h2>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Site Name & Tagline -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Portal Name</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'SOUND Group') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Site Tagline</label>
                    <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="form-control" required>
                </div>
            </div>

            <!-- Announcement Banner Text -->
            <div class="form-group">
                <label class="form-label">Top Announcement Banner (Displayed on Home Page)</label>
                <input type="text" name="announcement" value="{{ old('announcement', $settings['announcement'] ?? '') }}" class="form-control" placeholder="e.g. 🔥 NEW ADDITIONS: Check out our newest songs and videos!">
                <div class="form-text-muted">Displays with a flashing "NEW" animated badge on the hero section.</div>
            </div>

            <!-- Hero Headline & Subheadline -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Home Hero Headline</label>
                    <input type="text" name="hero_headline" value="{{ old('hero_headline', $settings['hero_headline'] ?? '') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Home Hero Subheadline</label>
                    <input type="text" name="hero_subheadline" value="{{ old('hero_subheadline', $settings['hero_subheadline'] ?? '') }}" class="form-control" required>
                </div>
            </div>

            <!-- About Section Title & Description -->
            <div class="form-group">
                <label class="form-label">About Section Title</label>
                <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title'] ?? '') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">About SOUND Group Full Description</label>
                <textarea name="about_description" rows="5" class="form-control" required>{{ old('about_description', $settings['about_description'] ?? '') }}</textarea>
            </div>

            <!-- Contact Information -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Contact Email-id</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Contact Phone Number</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Corporate Office Address</label>
                <textarea name="contact_address" rows="2" class="form-control" required>{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem; margin-top: 1rem;">
                Save Website Information
            </button>
        </form>
    </div>

</div>
@endsection
