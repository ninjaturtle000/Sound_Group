@extends('layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
<div>

    <!-- Welcome Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="font-size: 0.85rem; color: #a78bfa; font-weight: 700; text-transform: uppercase; margin-bottom: 0.35rem;">Control Center</div>
            <h1 style="font-size: 2.4rem; margin: 0;">Portal Management Dashboard</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Monitor entertainment metrics, media catalogs, user accounts, and website settings.</p>
        </div>

        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('admin.music.create') }}" class="btn-primary">
                + Add Music File
            </a>
            <a href="{{ route('admin.videos.create') }}" class="btn-secondary">
                + Add Video File
            </a>
            <a href="{{ route('admin.settings.export-backup') }}" class="btn-secondary" onclick="event.preventDefault(); document.getElementById('export-backup-form').submit();">
                💾 Export SQL Backup
            </a>
            <form id="export-backup-form" action="{{ route('admin.settings.export-backup') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Metric Stats Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
        
        <div class="glass-panel" style="padding: 1.5rem; border-top: 3px solid #10b981;">
            <div style="font-size: 0.78rem; text-transform: uppercase; color: var(--text-dim); font-weight: 700;">Music Tracks</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">{{ $stats['total_music'] }}</div>
            <div style="font-size: 0.8rem; color: #34d399; display: flex; align-items: center; gap: 4px;">
                <span class="badge-new-flash" style="font-size: 0.58rem; padding: 1px 4px;">NEW</span>
                <span>{{ $stats['new_music_count'] }} tracks active</span>
            </div>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-top: 3px solid #f43f5e;">
            <div style="font-size: 0.78rem; text-transform: uppercase; color: var(--text-dim); font-weight: 700;">Video Files</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">{{ $stats['total_videos'] }}</div>
            <div style="font-size: 0.8rem; color: #fb7185; display: flex; align-items: center; gap: 4px;">
                <span class="badge-new-flash" style="font-size: 0.58rem; padding: 1px 4px;">NEW</span>
                <span>{{ $stats['new_video_count'] }} videos active</span>
            </div>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-top: 3px solid #8b5cf6;">
            <div style="font-size: 0.78rem; text-transform: uppercase; color: var(--text-dim); font-weight: 700;">Registered Users</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">{{ $stats['total_users'] }}</div>
            <div style="font-size: 0.8rem; color: #c4b5fd;">Unique accounts validated</div>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-top: 3px solid #f59e0b;">
            <div style="font-size: 0.78rem; text-transform: uppercase; color: var(--text-dim); font-weight: 700;">Community Reviews</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">{{ $stats['total_reviews'] }}</div>
            <div style="font-size: 0.8rem; color: #fcd34d;">Ratings & critiques</div>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-top: 3px solid #06b6d4;">
            <div style="font-size: 0.78rem; text-transform: uppercase; color: var(--text-dim); font-weight: 700;">Categories & Eras</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">
                {{ $stats['total_artists'] + $stats['total_albums'] + $stats['total_genres'] + $stats['total_languages'] + $stats['total_years'] }}
            </div>
            <div style="font-size: 0.8rem; color: #67e8f9;">5 Category Classifications</div>
        </div>

    </div>

    <!-- 2 Column Overview Section: Recent Music & Recent Videos -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2.5rem;">
        
        <!-- Recent Music Table -->
        <div class="glass-panel" style="padding: 1.75rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h2 style="font-size: 1.3rem; margin: 0;">Recent Music Files</h2>
                <a href="{{ route('admin.music.index') }}" style="font-size: 0.82rem; color: var(--primary); font-weight: 600;">Manage All &rarr;</a>
            </div>

            <table class="table-dark-custom">
                <thead>
                    <tr>
                        <th>Track</th>
                        <th>Lang/Genre</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMusic as $m)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <img src="{{ $m->cover_image }}" style="width: 32px; height: 32px; border-radius: 4px; object-fit: cover;">
                                    <div>
                                        <div style="font-weight: 700; color: #fff; font-size: 0.85rem;">{{ Str::limit($m->title, 22) }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-dim);">{{ $m->artist->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-tag {{ $m->language->isRegional() ? 'badge-regional' : 'badge-english' }}" style="font-size: 0.68rem;">{{ $m->language->code }}</span>
                            </td>
                            <td>
                                @if($m->is_new)
                                    <span class="badge-new-flash" style="font-size: 0.6rem; padding: 1px 4px;">NEW</span>
                                @else
                                    <span style="font-size: 0.72rem; color: var(--text-dim);">Catalog</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    <a href="{{ route('admin.music.edit', $m->id) }}" style="color: #38bdf8; font-size: 0.8rem;">Edit</a>
                                    <form action="{{ route('admin.music.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Delete this music file?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #f43f5e; font-size: 0.8rem; cursor: pointer;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Recent Videos Table -->
        <div class="glass-panel" style="padding: 1.75rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h2 style="font-size: 1.3rem; margin: 0;">Recent Video Files</h2>
                <a href="{{ route('admin.videos.index') }}" style="font-size: 0.82rem; color: #ec4899; font-weight: 600;">Manage All &rarr;</a>
            </div>

            <table class="table-dark-custom">
                <thead>
                    <tr>
                        <th>Video</th>
                        <th>Lang/Genre</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentVideos as $v)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <img src="{{ $v->thumbnail_image }}" style="width: 44px; aspect-ratio: 16/9; border-radius: 4px; object-fit: cover;">
                                    <div>
                                        <div style="font-weight: 700; color: #fff; font-size: 0.85rem;">{{ Str::limit($v->title, 22) }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-dim);">{{ $v->artist->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-tag {{ $v->language->isRegional() ? 'badge-regional' : 'badge-english' }}" style="font-size: 0.68rem;">{{ $v->language->code }}</span>
                            </td>
                            <td>
                                @if($v->is_new)
                                    <span class="badge-new-flash" style="font-size: 0.6rem; padding: 1px 4px;">NEW</span>
                                @else
                                    <span style="font-size: 0.72rem; color: var(--text-dim);">Catalog</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    <a href="{{ route('admin.videos.edit', $v->id) }}" style="color: #38bdf8; font-size: 0.8rem;">Edit</a>
                                    <form action="{{ route('admin.videos.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Delete this video file?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #f43f5e; font-size: 0.8rem; cursor: pointer;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Recent Users Table -->
    <div class="glass-panel" style="padding: 1.75rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h2 style="font-size: 1.3rem; margin: 0;">Registered Users & Accounts</h2>
            <a href="{{ route('admin.users.index') }}" style="font-size: 0.82rem; color: #a78bfa; font-weight: 600;">Manage Users &rarr;</a>
        </div>

        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>USERID (Username)</th>
                    <th>Full Name</th>
                    <th>Email-id</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers as $u)
                    <tr>
                        <td><strong style="color: #38bdf8;">{{ $u->userid }}</strong></td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone }}</td>
                        <td>
                            <span class="badge-tag" style="background: {{ $u->role === 'admin' ? 'rgba(139,92,246,0.2)' : 'rgba(255,255,255,0.06)' }}; color: {{ $u->role === 'admin' ? '#c4b5fd' : '#cbd5e1' }}; font-weight: 700;">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>
                        <td>
                            <span style="color: {{ $u->is_active ? '#34d399' : '#f43f5e' }}; font-size: 0.82rem; font-weight: 600;">
                                {{ $u->is_active ? '● Active' : '○ Disabled' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
