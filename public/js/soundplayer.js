/**
 * SOUND Group - Interactive Audio Player Engine
 */

document.addEventListener('DOMContentLoaded', () => {
    const audio = new Audio();
    window.soundAudio = audio;

    const playBtn = document.getElementById('globalPlayBtn');
    const playIcon = document.getElementById('globalPlayIcon');
    const pauseIcon = document.getElementById('globalPauseIcon');
    const prevBtn = document.getElementById('globalPrevBtn');
    const nextBtn = document.getElementById('globalNextBtn');
    const progressBar = document.getElementById('globalProgressBar');
    const progressFill = document.getElementById('globalProgressFill');
    const currentTimeEl = document.getElementById('globalCurrentTime');
    const durationEl = document.getElementById('globalDuration');
    const volumeSlider = document.getElementById('globalVolumeSlider');
    const muteBtn = document.getElementById('globalMuteBtn');

    const coverEl = document.getElementById('playerCoverImg');
    const titleEl = document.getElementById('playerTrackTitle');
    const artistEl = document.getElementById('playerTrackArtist');
    const trackLink = document.getElementById('playerTrackLink');

    let isPlaying = false;
    let playlist = [];
    let currentIndex = 0;

    // Collect all playable tracks on page into playlist
    const trackElements = document.querySelectorAll('[data-track-url]');
    trackElements.forEach((el, idx) => {
        playlist.push({
            id: el.dataset.trackId || idx,
            url: el.dataset.trackUrl,
            title: el.dataset.trackTitle || 'Unknown Title',
            artist: el.dataset.trackArtist || 'SOUND Group',
            cover: el.dataset.trackCover || '',
            link: el.dataset.trackLink || '#',
        });
    });

    function formatTime(seconds) {
        if (isNaN(seconds)) return '0:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    }

    window.playTrack = function (url, title, artist, cover, link = '#', id = null) {
        if (!url) return;

        // Find or add to playlist
        let foundIdx = playlist.findIndex(p => p.url === url);
        if (foundIdx === -1) {
            playlist.push({ id, url, title, artist, cover, link });
            currentIndex = playlist.length - 1;
        } else {
            currentIndex = foundIdx;
        }

        audio.src = url;
        audio.play().then(() => {
            isPlaying = true;
            updatePlayIcon();
        }).catch(err => {
            console.log('Audio playback initiated:', err);
        });

        // Update UI
        if (titleEl) titleEl.textContent = title;
        if (artistEl) artistEl.textContent = artist;
        if (coverEl && cover) coverEl.src = cover;
        if (trackLink) trackLink.href = link;
    };

    function togglePlay() {
        if (!audio.src) {
            if (playlist.length > 0) {
                const first = playlist[0];
                window.playTrack(first.url, first.title, first.artist, first.cover, first.link, first.id);
            }
            return;
        }

        if (audio.paused) {
            audio.play();
            isPlaying = true;
        } else {
            audio.pause();
            isPlaying = false;
        }
        updatePlayIcon();
    }

    function updatePlayIcon() {
        if (audio.paused) {
            if (playIcon) playIcon.style.display = 'block';
            if (pauseIcon) pauseIcon.style.display = 'none';
        } else {
            if (playIcon) playIcon.style.display = 'none';
            if (pauseIcon) pauseIcon.style.display = 'block';
        }
    }

    if (playBtn) playBtn.addEventListener('click', togglePlay);

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (playlist.length === 0) return;
            currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
            const t = playlist[currentIndex];
            window.playTrack(t.url, t.title, t.artist, t.cover, t.link, t.id);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (playlist.length === 0) return;
            currentIndex = (currentIndex + 1) % playlist.length;
            const t = playlist[currentIndex];
            window.playTrack(t.url, t.title, t.artist, t.cover, t.link, t.id);
        });
    }

    audio.addEventListener('timeupdate', () => {
        if (audio.duration) {
            const pct = (audio.currentTime / audio.duration) * 100;
            if (progressFill) progressFill.style.width = `${pct}%`;
            if (currentTimeEl) currentTimeEl.textContent = formatTime(audio.currentTime);
            if (durationEl) durationEl.textContent = formatTime(audio.duration);
        }
    });

    audio.addEventListener('loadedmetadata', () => {
        if (durationEl) durationEl.textContent = formatTime(audio.duration);
    });

    audio.addEventListener('ended', () => {
        if (nextBtn) nextBtn.click();
    });

    if (progressBar) {
        progressBar.addEventListener('click', (e) => {
            const rect = progressBar.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            if (audio.duration) {
                audio.currentTime = pos * audio.duration;
            }
        });
    }

    if (volumeSlider) {
        volumeSlider.addEventListener('input', (e) => {
            audio.volume = e.target.value;
        });
    }

    if (muteBtn) {
        muteBtn.addEventListener('click', () => {
            audio.muted = !audio.muted;
            muteBtn.style.opacity = audio.muted ? '0.4' : '1';
        });
    }
});
