<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SOUND Group Entertainment') | Music & Video Portal</title>
    <meta name="description" content="@yield('meta_description', 'SOUND Group Entertainment portal hosting new and old Songs and Videos in both Regional and English languages.')">
    <meta name="theme-color" content="#0a0d14">
    
    <!-- Dark Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/soundgroup.css') }}">
    
    <!-- Alpine.js for lightweight dropdowns / interactive modals -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body>

    <!-- Top Navigation Bar -->
    <nav class="navbar-sound glass-nav">
        <div class="nav-container">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo" id="nav-brand-logo">
                <div class="brand-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18V5l12-2v13"></path>
                        <circle cx="6" cy="18" r="3"></circle>
                        <circle cx="18" cy="16" r="3"></circle>
                    </svg>
                </div>
                <div>SOUND<span class="sound-highlight">Group</span></div>
            </a>

            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="search-bar-wrap">
                <span class="search-icon-nav">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search music, video, artist, album, year..." autocomplete="off">
            </form>

            <!-- Menu Navigation Links -->
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('music.index') }}" class="{{ request()->routeIs('music.*') ? 'active' : '' }}">Music</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">Videos</a>
                </li>

                <!-- Categories Dropdown using Alpine.js -->
                <li class="nav-item" x-data="{ open: false }" style="position: relative;">
                    <a href="#" @click.prevent="open = !open" :class="{ 'active': open }" style="display: flex; align-items: center; gap: 4px;">
                        Categories
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                    <div x-show="open" @click.outside="open = false" x-transition style="position: absolute; top: 125%; left: 0; min-width: 200px; background: #121824; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.6); z-index: 1050; display: none;">
                        <a href="{{ route('categories.artists') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.88rem; color: #e2e8f0;">🎤 Artists</a>
                        <a href="{{ route('categories.albums') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.88rem; color: #e2e8f0;">💿 Albums</a>
                        <a href="{{ route('categories.genres') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.88rem; color: #e2e8f0;">🎸 Genres</a>
                        <a href="{{ route('categories.years') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.88rem; color: #e2e8f0;">📅 Years</a>
                        <a href="{{ route('categories.languages') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.88rem; color: #e2e8f0;">🌐 Regional & English</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                </li>
            </ul>

            <!-- Auth Controls -->
            <div class="auth-buttons">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-admin-badge" id="admin-panel-link">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            Admin Panel
                        </a>
                    @endif

                    <div x-data="{ open: false }" style="position: relative;">
                        <button @click="open = !open" style="background: none; border: none; display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <img src="{{ auth()->user()->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80' }}" alt="{{ auth()->user()->name }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                            <span style="font-size: 0.88rem; font-weight: 600; color: #ffffff;">{{ auth()->user()->userid }}</span>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition style="position: absolute; right: 0; top: 125%; min-width: 210px; background: #121824; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 0.6rem; box-shadow: 0 10px 30px rgba(0,0,0,0.7); z-index: 1050; display: none;">
                            <div style="padding: 0.5rem 0.8rem; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 0.4rem;">
                                <div style="font-size: 0.88rem; font-weight: 700; color: #fff;">{{ auth()->user()->name }}</div>
                                <div style="font-size: 0.75rem; color: #94a3b8;">{{ auth()->user()->email }}</div>
                            </div>
                            <a href="{{ route('profile') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.85rem; color: #cbd5e1;">👤 My Profile & Reviews</a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" style="display: block; padding: 0.5rem 0.8rem; border-radius: 6px; font-size: 0.85rem; color: #a78bfa;">⚙️ Admin Dashboard</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" style="margin-top: 0.4rem; padding-top: 0.4rem; border-top: 1px solid rgba(255,255,255,0.08);">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #f43f5e; padding: 0.5rem 0.8rem; font-size: 0.85rem; cursor: pointer; border-radius: 6px; font-weight: 600;">
                                    🚪 Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary" id="login-button">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-primary" id="register-button">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Global Alert Notifications -->
    <div class="main-wrapper" style="padding-top: 1.5rem; padding-bottom: 0;">
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="flex-direction: column; align-items: flex-start;">
                <div style="font-weight: 700; margin-bottom: 0.35rem;">Please review the following input errors:</div>
                <ul style="margin-left: 1.25rem; font-size: 0.85rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Dynamic Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-sound">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="brand-logo" style="margin-bottom: 1rem;">
                    <div class="brand-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18V5l12-2v13"></path>
                            <circle cx="6" cy="18" r="3"></circle>
                            <circle cx="18" cy="16" r="3"></circle>
                        </svg>
                    </div>
                    <div>SOUND<span class="sound-highlight">Group</span></div>
                </div>
                <p style="color: var(--text-dim); line-height: 1.7; font-size: 0.88rem; max-width: 360px;">
                    SOUND Group is your premier entertainment destination for streaming high-fidelity Music and Videos across both Regional and English languages.
                </p>
                <div style="margin-top: 1.25rem; display: flex; gap: 0.75rem;">
                    <span class="badge-tag badge-regional">Regional Music & Videos</span>
                    <span class="badge-tag badge-english">English Hits</span>
                </div>
            </div>

            <div class="footer-col">
                <h4>Navigation</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home Portal</a></li>
                    <li><a href="{{ route('music.index') }}">Music Collection</a></li>
                    <li><a href="{{ route('videos.index') }}">Video Library</a></li>
                    <li><a href="{{ route('about') }}">About SOUND Group</a></li>
                    <li><a href="{{ route('search') }}">Advanced Search</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Categories</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('categories.artists') }}">Artists Directory</a></li>
                    <li><a href="{{ route('categories.albums') }}">Albums Showcase</a></li>
                    <li><a href="{{ route('categories.genres') }}">Genres</a></li>
                    <li><a href="{{ route('categories.years') }}">Years & Eras</a></li>
                    <li><a href="{{ route('categories.languages') }}">Regional Languages</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact & Details</h4>
                <p style="font-size: 0.85rem; color: var(--text-dim); line-height: 1.7; margin-bottom: 0.5rem;">
                    <strong>SOUND Group Entertainment Tower</strong><br>
                    500 Melody Way, Suite 100<br>
                    Hollywood, CA 90028, USA
                </p>
                <p style="font-size: 0.85rem; color: var(--text-dim);">
                    <strong>Email:</strong> support@soundgroup.com<br>
                    <strong>Toll-Free:</strong> +1 (800) 555-SOUND
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; {{ date('Y') }} SOUND Group Entertainment Inc. All rights reserved. Built with Laravel 11.</div>
            <div style="display: flex; gap: 1.5rem;">
                <a href="{{ route('about') }}">Privacy & Terms</a>
                <a href="{{ route('categories.languages') }}">Regional Languages</a>
                <a href="{{ route('login') }}">Member Access</a>
            </div>
        </div>
    </footer>

    <!-- Bottom Persistent Audio Player Bar -->
    <div class="audio-player-bar" id="globalAudioPlayer">
        <!-- Track Info -->
        <div class="player-track-info">
            <img id="playerCoverImg" src="https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=100&auto=format&fit=crop&q=80" alt="Track Cover" class="player-cover">
            <div class="player-details">
                <a id="playerTrackLink" href="#" class="player-title" id="playerTrackTitle">Select a track to play</a>
                <div class="player-artist" id="playerTrackArtist">SOUND Group Entertainment</div>
            </div>
        </div>

        <!-- Controls Center -->
        <div class="player-controls-center">
            <div class="player-buttons">
                <button type="button" class="ctrl-btn" id="globalPrevBtn" title="Previous Track">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="19 20 9 12 19 4 19 20"></polygon>
                        <line x1="5" y1="19" x2="5" y2="5"></line>
                    </svg>
                </button>

                <button type="button" class="ctrl-btn ctrl-btn-play" id="globalPlayBtn" title="Play / Pause">
                    <svg id="globalPlayIcon" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    <svg id="globalPauseIcon" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                        <rect x="6" y="4" width="4" height="16"></rect>
                        <rect x="14" y="4" width="4" height="16"></rect>
                    </svg>
                </button>

                <button type="button" class="ctrl-btn" id="globalNextBtn" title="Next Track">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 4 15 12 5 20 5 4"></polygon>
                        <line x1="19" y1="5" x2="19" y2="19"></line>
                    </svg>
                </button>
            </div>

            <!-- Progress Bar -->
            <div class="progress-wrap">
                <span id="globalCurrentTime">0:00</span>
                <div class="progress-bar-bg" id="globalProgressBar">
                    <div class="progress-fill" id="globalProgressFill">
                        <div class="progress-handle"></div>
                    </div>
                </div>
                <span id="globalDuration">0:00</span>
            </div>
        </div>

        <!-- Extra Controls (Volume & Mute) -->
        <div class="player-extra-controls">
            <button type="button" class="ctrl-btn" id="globalMuteBtn" title="Mute / Unmute">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                </svg>
            </button>
            <input type="range" class="volume-slider" id="globalVolumeSlider" min="0" max="1" step="0.05" value="0.8" title="Volume">
        </div>
    </div>

    <!-- Audio Player Script -->
    <script src="{{ asset('js/soundplayer.js') }}"></script>
    @stack('scripts')
</body>
</html>
