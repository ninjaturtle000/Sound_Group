@extends('layouts.admin')

@section('title', 'Manage Music Files - Admin')

@section('content')
<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Music Files Catalog</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Add, edit, toggle flashing NEW status, or delete music files.</p>
        </div>
        <a href="{{ route('admin.music.create') }}" class="btn-primary">
            + Add New Music File
        </a>
    </div>

    <!-- Search / Filter Bar -->
    <div class="glass-panel" style="padding: 1.25rem; margin-bottom: 2rem;">
        <form action="{{ route('admin.music.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by title or artist..." class="form-control" style="flex: 1; min-width: 240px;">
            <select name="is_new" class="form-control" style="width: auto;">
                <option value="">All Statuses</option>
                <option value="1" {{ request('is_new') === '1' ? 'selected' : '' }}>Flashing NEW Only</option>
                <option value="0" {{ request('is_new') === '0' ? 'selected' : '' }}>Catalog Only</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
            <a href="{{ route('admin.music.index') }}" class="btn-secondary">Reset</a>
        </form>
    </div>

    <!-- Music Table -->
    <div class="glass-panel" style="overflow-x: auto; padding: 0.5rem;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>Track & Cover</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Year</th>
                    <th>Plays</th>
                    <th>Flashing NEW</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($musics as $song)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ $song->cover_image }}" style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                                <div>
                                    <a href="{{ route('music.show', $song->id) }}" target="_blank" style="font-weight: 700; color: #fff;">{{ $song->title }}</a>
                                    <div style="font-size: 0.75rem; color: var(--text-dim);">{{ $song->duration }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $song->artist->name }}</td>
                        <td>{{ $song->album ? $song->album->title : 'Single' }}</td>
                        <td>{{ $song->genre->name }}</td>
                        <td>
                            <span class="badge-tag {{ $song->language->isRegional() ? 'badge-regional' : 'badge-english' }}">
                                {{ $song->language->name }}
                            </span>
                        </td>
                        <td>{{ $song->year->year }}</td>
                        <td>{{ number_format($song->plays_count) }}</td>
                        <td>
                            <form action="{{ route('admin.music.toggle-new', $song->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    @if($song->is_new)
                                        <span class="badge-new-flash">NEW (ON)</span>
                                    @else
                                        <span style="font-size: 0.75rem; padding: 3px 8px; border-radius: 9999px; background: rgba(255,255,255,0.06); color: var(--text-dim);">
                                            OFF
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="{{ route('admin.music.edit', $song->id) }}" class="btn-secondary" style="font-size: 0.78rem; padding: 0.35rem 0.75rem;">
                                    Edit
                                </a>
                                <form action="{{ route('admin.music.destroy', $song->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($song->title) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-outline-danger" style="font-size: 0.78rem; padding: 0.35rem 0.75rem;">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 3rem; color: var(--text-dim);">
                            No music files found. Click "Add New Music File" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: center; margin-top: 1.5rem;">
        {{ $musics->links() }}
    </div>
</div>
@endsection
