@extends('layouts.admin')

@section('title', 'Manage Categories - Admin')

@section('content')
<div x-data="{ activeTab: '{{ $tab }}' }">

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Categories & Classification</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Create and manage Artists, Albums, Genres, Release Years, and Languages.</p>
        </div>

        <!-- Tab Switchers -->
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <button type="button" @click="activeTab = 'artists'" :class="{ 'active': activeTab === 'artists' }" class="pill-item" style="cursor: pointer; border: 1px solid var(--border-color);">
                🎤 Artists ({{ $artists->total() }})
            </button>
            <button type="button" @click="activeTab = 'albums'" :class="{ 'active': activeTab === 'albums' }" class="pill-item" style="cursor: pointer; border: 1px solid var(--border-color);">
                💿 Albums ({{ $albums->total() }})
            </button>
            <button type="button" @click="activeTab = 'genres'" :class="{ 'active': activeTab === 'genres' }" class="pill-item" style="cursor: pointer; border: 1px solid var(--border-color);">
                🎸 Genres ({{ $genres->count() }})
            </button>
            <button type="button" @click="activeTab = 'years'" :class="{ 'active': activeTab === 'years' }" class="pill-item" style="cursor: pointer; border: 1px solid var(--border-color);">
                📅 Years ({{ $years->count() }})
            </button>
            <button type="button" @click="activeTab = 'languages'" :class="{ 'active': activeTab === 'languages' }" class="pill-item" style="cursor: pointer; border: 1px solid var(--border-color);">
                🌐 Languages ({{ $languages->count() }})
            </button>
        </div>
    </div>

    <!-- TAB 1: ARTISTS -->
    <div x-show="activeTab === 'artists'" style="display: none;">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: flex-start;">
            
            <!-- Create Artist Form -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 1.25rem; color: #fff;">+ Create New Artist</h3>
                <form action="{{ route('admin.categories.artists.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Artist / Performer Name <span class="required-mark">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. A.R. Rahman" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Country / Region</label>
                        <input type="text" name="country" class="form-control" placeholder="e.g. India, Canada, UK">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Profile Image URL</label>
                        <input type="url" name="image" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Short Biography</label>
                        <textarea name="bio" rows="3" class="form-control" placeholder="Brief career highlights..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                        Save Artist
                    </button>
                </form>
            </div>

            <!-- Artists List Table -->
            <div class="glass-panel" style="padding: 1rem; overflow-x: auto;">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Artist</th>
                            <th>Country</th>
                            <th>Music</th>
                            <th>Videos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artists as $art)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <img src="{{ $art->image }}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                        <span style="font-weight: 700; color: #fff;">{{ $art->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $art->country }}</td>
                                <td>{{ $art->musics_count }}</td>
                                <td>{{ $art->videos_count }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.artists.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Delete artist \'{{ addslashes($art->name) }}\'? All linked media will also be deleted.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-danger" style="font-size: 0.75rem; padding: 2px 6px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 1rem;">
                    {{ $artists->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 2: ALBUMS -->
    <div x-show="activeTab === 'albums'" style="display: none;">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: flex-start;">
            
            <!-- Create Album Form -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 1.25rem; color: #fff;">+ Create New Album</h3>
                <form action="{{ route('admin.categories.albums.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Album Title <span class="required-mark">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. After Hours" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Artist <span class="required-mark">*</span></label>
                        <select name="artist_id" class="form-control" required>
                            @foreach($artists as $art)
                                <option value="{{ $art->id }}">{{ $art->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Release Year</label>
                        <input type="number" name="release_year" class="form-control" value="{{ date('Y') }}" min="1900" max="2099">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cover Artwork URL</label>
                        <input type="url" name="cover_image" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="2" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                        Save Album
                    </button>
                </form>
            </div>

            <!-- Albums List Table -->
            <div class="glass-panel" style="padding: 1rem; overflow-x: auto;">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Cover & Title</th>
                            <th>Artist</th>
                            <th>Year</th>
                            <th>Songs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($albums as $alb)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <img src="{{ $alb->cover_image }}" style="width: 32px; height: 32px; border-radius: 4px; object-fit: cover;">
                                        <span style="font-weight: 700; color: #fff;">{{ $alb->title }}</span>
                                    </div>
                                </td>
                                <td>{{ $alb->artist->name }}</td>
                                <td>{{ $alb->release_year }}</td>
                                <td>{{ $alb->musics_count }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.albums.destroy', $alb->id) }}" method="POST" onsubmit="return confirm('Delete album \'{{ addslashes($alb->title) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-danger" style="font-size: 0.75rem; padding: 2px 6px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 1rem;">
                    {{ $albums->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 3: GENRES -->
    <div x-show="activeTab === 'genres'" style="display: none;">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: flex-start;">
            
            <!-- Create Genre Form -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 1.25rem; color: #fff;">+ Create New Genre</h3>
                <form action="{{ route('admin.categories.genres.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Genre Name <span class="required-mark">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Lo-Fi Hip Hop" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Accent Color Code</label>
                        <input type="color" name="color" class="form-control" value="#10b981" style="height: 44px; padding: 4px;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Sonic characteristics of this genre..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                        Save Genre
                    </button>
                </form>
            </div>

            <!-- Genres List Table -->
            <div class="glass-panel" style="padding: 1rem; overflow-x: auto;">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Genre Name</th>
                            <th>Color</th>
                            <th>Description</th>
                            <th>Media Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genres as $gen)
                            <tr>
                                <td><strong style="color: #fff;">{{ $gen->name }}</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        <span style="width: 14px; height: 14px; border-radius: 50%; background: {{ $gen->color }}; display: inline-block;"></span>
                                        <span style="font-size: 0.75rem; color: var(--text-dim);">{{ $gen->color }}</span>
                                    </div>
                                </td>
                                <td style="font-size: 0.82rem; color: var(--text-muted); max-width: 250px;">{{ Str::limit($gen->description, 60) }}</td>
                                <td>{{ $gen->musics_count + $gen->videos_count }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.genres.destroy', $gen->id) }}" method="POST" onsubmit="return confirm('Delete genre \'{{ addslashes($gen->name) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-danger" style="font-size: 0.75rem; padding: 2px 6px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- TAB 4: YEARS -->
    <div x-show="activeTab === 'years'" style="display: none;">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: flex-start;">
            
            <!-- Create Year Form -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 1.25rem; color: #fff;">+ Add Release Year</h3>
                <form action="{{ route('admin.categories.years.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Year Number <span class="required-mark">*</span></label>
                        <input type="number" name="year" class="form-control" placeholder="e.g. 2026" min="1900" max="2099" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Era Description</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Highlights of releases during this year..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                        Save Year
                    </button>
                </form>
            </div>

            <!-- Years List Table -->
            <div class="glass-panel" style="padding: 1rem; overflow-x: auto;">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Description</th>
                            <th>Songs</th>
                            <th>Videos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($years as $yr)
                            <tr>
                                <td><strong style="color: #38bdf8; font-size: 1.1rem;">{{ $yr->year }}</strong></td>
                                <td style="font-size: 0.82rem; color: var(--text-muted);">{{ $yr->description }}</td>
                                <td>{{ $yr->musics_count }}</td>
                                <td>{{ $yr->videos_count }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.years.destroy', $yr->id) }}" method="POST" onsubmit="return confirm('Delete year {{ $yr->year }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-danger" style="font-size: 0.75rem; padding: 2px 6px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- TAB 5: LANGUAGES (REGIONAL & ENGLISH) -->
    <div x-show="activeTab === 'languages'" style="display: none;">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: flex-start;">
            
            <!-- Create Language Form -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 1.25rem; color: #fff;">+ Add Language (Regional/English)</h3>
                <form action="{{ route('admin.categories.languages.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Language Name <span class="required-mark">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Marathi, Telugu, Spanish" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Language Code (2-4 letters) <span class="required-mark">*</span></label>
                        <input type="text" name="code" class="form-control" placeholder="e.g. MR, TE, ES" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Language Classification <span class="required-mark">*</span></label>
                        <select name="type" class="form-control" required>
                            <option value="regional">Regional Language</option>
                            <option value="english">English Language</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                        Save Language
                    </button>
                </form>
            </div>

            <!-- Languages List Table -->
            <div class="glass-panel" style="padding: 1rem; overflow-x: auto;">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Language</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Songs</th>
                            <th>Videos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $lang)
                            <tr>
                                <td><strong style="color: #fff;">{{ $lang->name }}</strong></td>
                                <td><span style="font-size: 0.75rem; color: var(--text-dim); background: rgba(255,255,255,0.06); padding: 2px 6px; border-radius: 4px;">{{ $lang->code }}</span></td>
                                <td>
                                    <span class="badge-tag {{ $lang->type === 'regional' ? 'badge-regional' : 'badge-english' }}">
                                        {{ ucfirst($lang->type) }}
                                    </span>
                                </td>
                                <td>{{ $lang->musics_count }}</td>
                                <td>{{ $lang->videos_count }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.languages.destroy', $lang->id) }}" method="POST" onsubmit="return confirm('Delete language \'{{ addslashes($lang->name) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-danger" style="font-size: 0.75rem; padding: 2px 6px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
