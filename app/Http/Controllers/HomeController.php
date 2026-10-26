<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Music;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Models\Video;
use App\Models\Year;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Latest 5 Music with relationships
        $latestMusic = Music::with(['artist', 'album', 'genre', 'language', 'year'])
            ->orderByDesc('is_new')
            ->latest()
            ->take(5)
            ->get();

        // 2. Latest 5 Videos with relationships
        $latestVideos = Video::with(['artist', 'album', 'genre', 'language', 'year'])
            ->orderByDesc('is_new')
            ->latest()
            ->take(5)
            ->get();

        // 3. Featured Hero Track (top played or first new track)
        $heroMusic = $latestMusic->first();

        // 4. Categories summary
        $genres = Genre::withCount('musics')->orderBy('name')->take(8)->get();
        $regionalLanguages = Language::where('type', 'regional')->withCount(['musics', 'videos'])->get();
        $englishLanguage = Language::where('type', 'english')->withCount(['musics', 'videos'])->first();
        $artists = Artist::withCount('musics')->latest()->take(6)->get();
        $albums = Album::with(['artist', 'year'])->latest()->take(6)->get();
        $years = Year::orderByDesc('year')->take(6)->get();

        // 5. Site Settings & Information
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'SOUND Group'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Entertainment Redefined'),
            'about_title' => SiteSetting::get('about_title', 'About SOUND Group'),
            'about_description' => SiteSetting::get('about_description', 'SOUND Group is an international entertainment portal hosting new and old Songs and Videos in both Regional and English languages.'),
            'announcement' => SiteSetting::get('announcement', 'Welcome to SOUND Group Entertainment!'),
            'hero_headline' => SiteSetting::get('hero_headline', 'Stream Extraordinary Music & Videos'),
            'hero_subheadline' => SiteSetting::get('hero_subheadline', 'Explore classic hits and trending releases across Regional and English languages.'),
            'contact_email' => SiteSetting::get('contact_email', 'contact@soundgroup.com'),
            'contact_phone' => SiteSetting::get('contact_phone', '+1 (800) 555-SOUND'),
            'contact_address' => SiteSetting::get('contact_address', 'SOUND Group Tower, Los Angeles, CA'),
        ];

        // 6. Platform Statistics
        $stats = [
            'music_count' => Music::count(),
            'video_count' => Video::count(),
            'artist_count' => Artist::count(),
            'album_count' => Album::count(),
            'language_count' => Language::count(),
            'review_count' => Review::count(),
        ];

        return view('pages.home', compact(
            'latestMusic',
            'latestVideos',
            'heroMusic',
            'genres',
            'regionalLanguages',
            'englishLanguage',
            'artists',
            'albums',
            'years',
            'settings',
            'stats'
        ));
    }

    public function about()
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'SOUND Group'),
            'about_title' => SiteSetting::get('about_title', 'About SOUND Group Entertainment'),
            'about_description' => SiteSetting::get('about_description', 'SOUND Group is an entertainment portal hosting new and old songs and videos in both Regional and English languages.'),
            'contact_email' => SiteSetting::get('contact_email', 'contact@soundgroup.com'),
            'contact_phone' => SiteSetting::get('contact_phone', '+1 (800) 555-SOUND'),
            'contact_address' => SiteSetting::get('contact_address', 'SOUND Group Entertainment Tower, 500 Melody Way, Suite 100, Los Angeles, CA 90028'),
            'announcement' => SiteSetting::get('announcement', ''),
        ];

        $stats = [
            'music_count' => Music::count(),
            'video_count' => Video::count(),
            'artist_count' => Artist::count(),
            'album_count' => Album::count(),
            'language_count' => Language::count(),
            'review_count' => Review::count(),
        ];

        return view('pages.about', compact('settings', 'stats'));
    }
}
