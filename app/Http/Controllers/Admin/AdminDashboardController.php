<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Music;
use App\Models\Review;
use App\Models\User;
use App\Models\Video;
use App\Models\Year;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_music' => Music::count(),
            'total_videos' => Video::count(),
            'total_users' => User::count(),
            'total_artists' => Artist::count(),
            'total_albums' => Album::count(),
            'total_genres' => Genre::count(),
            'total_languages' => Language::count(),
            'total_years' => Year::count(),
            'total_reviews' => Review::count(),
            'new_music_count' => Music::where('is_new', true)->count(),
            'new_video_count' => Video::where('is_new', true)->count(),
        ];

        $recentMusic = Music::with(['artist', 'genre', 'language'])->latest()->take(5)->get();
        $recentVideos = Video::with(['artist', 'genre', 'language'])->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $recentReviews = Review::with(['user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMusic', 'recentVideos', 'recentUsers', 'recentReviews'));
    }
}
