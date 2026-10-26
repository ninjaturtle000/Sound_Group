<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Music;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\Video;
use App\Models\Year;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for SOUND Group.
     */
    public function run(): void
    {
        // 1. Users (Admin + Regular Users)
        $admin = User::create([
            'userid' => 'admin',
            'name' => 'SOUND Administrator',
            'email' => 'admin@soundgroup.com',
            'phone' => '+1 800-555-0199',
            'address' => 'SOUND Group Tower, 500 Melody Way, Hollywood, CA 90028',
            'role' => 'admin',
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
            'is_active' => true,
            'password' => Hash::make('admin123'),
        ]);

        $user1 = User::create([
            'userid' => 'johndoe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1 555-234-5678',
            'address' => '742 Evergreen Terrace, Springfield, OR 97477',
            'role' => 'user',
            'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80',
            'is_active' => true,
            'password' => Hash::make('user123'),
        ]);

        $user2 = User::create([
            'userid' => 'priyasharma',
            'name' => 'Priya Sharma',
            'email' => 'priya@example.com',
            'phone' => '+91 98765 43210',
            'address' => '45 Marine Drive, Nariman Point, Mumbai 400021, India',
            'role' => 'user',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80',
            'is_active' => true,
            'password' => Hash::make('user123'),
        ]);

        // 2. Languages (Regional & English)
        $languagesData = [
            ['name' => 'English', 'code' => 'EN', 'type' => 'english'],
            ['name' => 'Hindi', 'code' => 'HI', 'type' => 'regional'],
            ['name' => 'Tamil', 'code' => 'TA', 'type' => 'regional'],
            ['name' => 'Telugu', 'code' => 'TE', 'type' => 'regional'],
            ['name' => 'Punjabi', 'code' => 'PA', 'type' => 'regional'],
            ['name' => 'Spanish', 'code' => 'ES', 'type' => 'regional'],
            ['name' => 'French', 'code' => 'FR', 'type' => 'regional'],
            ['name' => 'Korean', 'code' => 'KO', 'type' => 'regional'],
        ];

        $languages = [];
        foreach ($languagesData as $lang) {
            $languages[$lang['code']] = Language::create($lang);
        }

        // 3. Genres
        $genresData = [
            ['name' => 'Pop', 'slug' => 'pop', 'description' => 'Catchy, melodic mainstream and contemporary tunes.', 'color' => '#EC4899'],
            ['name' => 'Rock', 'slug' => 'rock', 'description' => 'Guitar-driven anthems, classic rock, and indie alternative.', 'color' => '#EF4444'],
            ['name' => 'Hip Hop & Rap', 'slug' => 'hip-hop-rap', 'description' => 'Rhythmic lyricism, trap beats, and urban storytelling.', 'color' => '#F59E0B'],
            ['name' => 'Bollywood & Film', 'slug' => 'bollywood-film', 'description' => 'Cinematic regional masterpieces, emotional melodies, and dance beats.', 'color' => '#10B981'],
            ['name' => 'Classical & Carnatic', 'slug' => 'classical-carnatic', 'description' => 'Timeless ragas, orchestral symphonies, and meditative instrumentation.', 'color' => '#8B5CF6'],
            ['name' => 'Electronic & Dance', 'slug' => 'electronic-dance', 'description' => 'Synthesizers, club drops, house, and EDM energy.', 'color' => '#06B6D4'],
            ['name' => 'R&B & Soul', 'slug' => 'r-and-b-soul', 'description' => 'Smooth vocal harmonies, neo-soul warmth, and deep grooves.', 'color' => '#6366F1'],
            ['name' => 'Folk & Acoustic', 'slug' => 'folk-acoustic', 'description' => 'Traditional regional ballads, unplugged guitars, and cultural heritage.', 'color' => '#84CC16'],
        ];

        $genres = [];
        foreach ($genresData as $g) {
            $genres[$g['slug']] = Genre::create($g);
        }

        // 4. Years
        $yearValues = [1990, 1998, 2005, 2013, 2018, 2020, 2022, 2024, 2025, 2026];
        $years = [];
        foreach ($yearValues as $yr) {
            $years[$yr] = Year::create([
                'year' => $yr,
                'description' => "Era of {$yr} releases and greatest hits",
            ]);
        }

        // 5. Artists (Regional and Global)
        $artistsData = [
            [
                'name' => 'The Weeknd',
                'slug' => 'the-weeknd',
                'bio' => 'Canadian singer, songwriter, and record producer known for his sonic versatility and dark lyricism.',
                'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80',
                'country' => 'Canada',
            ],
            [
                'name' => 'A.R. Rahman',
                'slug' => 'ar-rahman',
                'bio' => 'Two-time Academy Award-winning Indian composer known as the Mozart of Madras, blending Eastern classical with modern sounds.',
                'image' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=500&auto=format&fit=crop&q=80',
                'country' => 'India',
            ],
            [
                'name' => 'Dua Lipa',
                'slug' => 'dua-lipa',
                'bio' => 'Grammy-winning British-Albanian pop powerhouse behind modern disco-pop revival.',
                'image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=80',
                'country' => 'United Kingdom',
            ],
            [
                'name' => 'Arijit Singh',
                'slug' => 'arijit-singh',
                'bio' => 'Acclaimed Indian playback singer and music composer renowned for his soul-stirring romantic and emotional vocals.',
                'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=500&auto=format&fit=crop&q=80',
                'country' => 'India',
            ],
            [
                'name' => 'Diljit Dosanjh',
                'slug' => 'diljit-dosanjh',
                'bio' => 'Global Punjabi icon, singer, and actor representing authentic regional bhangra-fusion on world stages.',
                'image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&auto=format&fit=crop&q=80',
                'country' => 'India',
            ],
            [
                'name' => 'Daft Punk',
                'slug' => 'daft-punk',
                'bio' => 'Legendary French electronic music duo pioneers of French touch and futuristic funk.',
                'image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=500&auto=format&fit=crop&q=80',
                'country' => 'France',
            ],
            [
                'name' => 'Sid Sriram',
                'slug' => 'sid-sriram',
                'bio' => 'Indian-American Carnatic musician, music producer and playback singer leading contemporary South Indian cinema.',
                'image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=500&auto=format&fit=crop&q=80',
                'country' => 'India / USA',
            ],
            [
                'name' => 'Rosalía',
                'slug' => 'rosalia',
                'bio' => 'Innovative Spanish singer and songwriter revolutionizing flamenco with reggaeton and urban electronic beats.',
                'image' => 'https://images.unsplash.com/photo-1520523839898-507124cd5371?w=500&auto=format&fit=crop&q=80',
                'country' => 'Spain',
            ],
        ];

        $artists = [];
        foreach ($artistsData as $a) {
            $artists[$a['slug']] = Artist::create($a);
        }

        // 6. Albums
        $albumsData = [
            [
                'title' => 'After Hours',
                'slug' => 'after-hours',
                'artist_id' => $artists['the-weeknd']->id,
                'genre_id' => $genres['r-and-b-soul']->id,
                'year_id' => $years[2020]->id,
                'language_id' => $languages['EN']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=500&auto=format&fit=crop&q=80',
                'description' => 'Critically acclaimed synth-wave and dark R&B masterpiece by The Weeknd.',
                'release_year' => 2020,
            ],
            [
                'title' => 'Dil Se (Original Motion Picture)',
                'slug' => 'dil-se',
                'artist_id' => $artists['ar-rahman']->id,
                'genre_id' => $genres['bollywood-film']->id,
                'year_id' => $years[1998]->id,
                'language_id' => $languages['HI']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&auto=format&fit=crop&q=80',
                'description' => 'Timeless landmark soundtrack by A.R. Rahman exploring the seven shades of love.',
                'release_year' => 1998,
            ],
            [
                'title' => 'Future Nostalgia',
                'slug' => 'future-nostalgia',
                'artist_id' => $artists['dua-lipa']->id,
                'genre_id' => $genres['pop']->id,
                'year_id' => $years[2020]->id,
                'language_id' => $languages['EN']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?w=500&auto=format&fit=crop&q=80',
                'description' => 'Bright disco-funk and dance-pop studio album.',
                'release_year' => 2020,
            ],
            [
                'title' => 'G.O.A.T.',
                'slug' => 'goat-album',
                'artist_id' => $artists['diljit-dosanjh']->id,
                'genre_id' => $genres['hip-hop-rap']->id,
                'year_id' => $years[2020]->id,
                'language_id' => $languages['PA']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80',
                'description' => 'Record-shattering Punjabi hip-hop album that charted worldwide.',
                'release_year' => 2020,
            ],
            [
                'title' => 'Random Access Memories',
                'slug' => 'random-access-memories',
                'artist_id' => $artists['daft-punk']->id,
                'genre_id' => $genres['electronic-dance']->id,
                'year_id' => $years[2013]->id,
                'language_id' => $languages['FR']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&auto=format&fit=crop&q=80',
                'description' => 'A tribute to late-1970s and early-1980s American music by Daft Punk.',
                'release_year' => 2013,
            ],
            [
                'title' => 'Motomami Deluxe',
                'slug' => 'motomami-deluxe',
                'artist_id' => $artists['rosalia']->id,
                'genre_id' => $genres['pop']->id,
                'year_id' => $years[2022]->id,
                'language_id' => $languages['ES']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&auto=format&fit=crop&q=80',
                'description' => 'Experimental pop and avant-garde Spanish reggaeton masterwork.',
                'release_year' => 2022,
            ],
            [
                'title' => 'Midnight Melodies & Ragas',
                'slug' => 'midnight-melodies',
                'artist_id' => $artists['sid-sriram']->id,
                'genre_id' => $genres['classical-carnatic']->id,
                'year_id' => $years[2026]->id,
                'language_id' => $languages['TA']->id,
                'cover_image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=500&auto=format&fit=crop&q=80',
                'description' => 'Fresh modern fusion of Carnatic vocal depth and ambient acoustic warmth.',
                'release_year' => 2026,
            ],
        ];

        $albums = [];
        foreach ($albumsData as $alb) {
            $albums[$alb['slug']] = Album::create($alb);
        }

        // 7. Music Tracks (Ensure at least 5 have is_new = true for the Latest 5 listings)
        $musicsData = [
            // Track 1 (NEW)
            [
                'title' => 'Blinding Lights (Midnight Echoes)',
                'slug' => 'blinding-lights-midnight-echoes',
                'artist_id' => $artists['the-weeknd']->id,
                'album_id' => $albums['after-hours']->id,
                'genre_id' => $genres['pop']->id,
                'language_id' => $languages['EN']->id,
                'year_id' => $years[2026]->id,
                'duration' => '3:22',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=500&auto=format&fit=crop&q=80',
                'description' => 'Electrifying 80s synth-wave single with neon drenched beats and soaring vocals.',
                'lyrics' => "I've been on my own for long enough, maybe you can show me how to love, maybe...\nI'm running out of time, 'cause I can see the sun light up the sky.",
                'is_new' => true,
                'plays_count' => 12450,
            ],
            // Track 2 (NEW)
            [
                'title' => 'Chaiyya Chaiyya (2026 Remaster)',
                'slug' => 'chaiyya-chaiyya-remaster',
                'artist_id' => $artists['ar-rahman']->id,
                'album_id' => $albums['dil-se']->id,
                'genre_id' => $genres['bollywood-film']->id,
                'language_id' => $languages['HI']->id,
                'year_id' => $years[2026]->id,
                'duration' => '6:54',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&auto=format&fit=crop&q=80',
                'description' => 'The ultimate Sufi-folk train rhythm remastered in Dolby Atmos audio by SOUND Group.',
                'lyrics' => "Jinke sar ho ishq ki chhaaon, paanv ke neeche jannat hogi...\nChal chhaiyya chhaiyya chhaiyya chhaiyya!",
                'is_new' => true,
                'plays_count' => 38920,
            ],
            // Track 3 (NEW)
            [
                'title' => 'Levitating (Club Future Groove)',
                'slug' => 'levitating-club-future-groove',
                'artist_id' => $artists['dua-lipa']->id,
                'album_id' => $albums['future-nostalgia']->id,
                'genre_id' => $genres['pop']->id,
                'language_id' => $languages['EN']->id,
                'year_id' => $years[2026]->id,
                'duration' => '3:23',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?w=500&auto=format&fit=crop&q=80',
                'description' => 'High octane space disco groove with irresistible basslines.',
                'lyrics' => "If you wanna run away with me, I know a galaxy and I can take you for a ride...\nI had a premonition that we fell into a rhythm.",
                'is_new' => true,
                'plays_count' => 29400,
            ],
            // Track 4 (NEW)
            [
                'title' => 'G.O.A.T. Anthem (Urban Mix)',
                'slug' => 'goat-anthem-urban-mix',
                'artist_id' => $artists['diljit-dosanjh']->id,
                'album_id' => $albums['goat-album']->id,
                'genre_id' => $genres['hip-hop-rap']->id,
                'language_id' => $languages['PA']->id,
                'year_id' => $years[2026]->id,
                'duration' => '3:45',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80',
                'description' => 'Unapologetic Punjabi swag featuring hard-hitting 808s and folk dhol loops.',
                'lyrics' => "Ho jithe hath paa laye othe karde kamaal ni, jatt di chadhayi de taan dinde lok misaal ni!",
                'is_new' => true,
                'plays_count' => 45100,
            ],
            // Track 5 (NEW)
            [
                'title' => 'Kannana Kanne (Acoustic Sunrise)',
                'slug' => 'kannana-kanne-acoustic-sunrise',
                'artist_id' => $artists['sid-sriram']->id,
                'album_id' => $albums['midnight-melodies']->id,
                'genre_id' => $genres['classical-carnatic']->id,
                'language_id' => $languages['TA']->id,
                'year_id' => $years[2026]->id,
                'duration' => '4:28',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=500&auto=format&fit=crop&q=80',
                'description' => 'Heart-melting regional Tamil ballad sung with deep emotional precision by Sid Sriram.',
                'lyrics' => "Kannana kanne kannana kanne en meedhu saaya vaa...\nUllukullae unnai naan aravanaikka vaa...",
                'is_new' => true,
                'plays_count' => 21800,
            ],
            // Track 6 (Catalog / Classic)
            [
                'title' => 'Kesariya (Eternal Flame)',
                'slug' => 'kesariya-eternal-flame',
                'artist_id' => $artists['arijit-singh']->id,
                'album_id' => null,
                'genre_id' => $genres['bollywood-film']->id,
                'language_id' => $languages['HI']->id,
                'year_id' => $years[2022]->id,
                'duration' => '4:28',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=500&auto=format&fit=crop&q=80',
                'description' => 'Arijit Singh at his peak, delivering melodic romantic transcendence.',
                'lyrics' => "Kesariya tera ishq hai piya, rang jaaun jo main haath lagaun...",
                'is_new' => false,
                'plays_count' => 98400,
            ],
            // Track 7 (Catalog / Classic)
            [
                'title' => 'Get Lucky (French Touch Edition)',
                'slug' => 'get-lucky-french-touch',
                'artist_id' => $artists['daft-punk']->id,
                'album_id' => $albums['random-access-memories']->id,
                'genre_id' => $genres['electronic-dance']->id,
                'language_id' => $languages['FR']->id,
                'year_id' => $years[2013]->id,
                'duration' => '4:08',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&auto=format&fit=crop&q=80',
                'description' => 'Funk guitar grooves meet vocoder harmonies in one of the most awarded dance anthems of the decade.',
                'lyrics' => "Like the legend of the phoenix, all ends with beginnings...",
                'is_new' => false,
                'plays_count' => 88100,
            ],
            // Track 8 (Catalog / Regional Spanish)
            [
                'title' => 'Saoko (Neon Fuego)',
                'slug' => 'saoko-neon-fuego',
                'artist_id' => $artists['rosalia']->id,
                'album_id' => $albums['motomami-deluxe']->id,
                'genre_id' => $genres['pop']->id,
                'language_id' => $languages['ES']->id,
                'year_id' => $years[2022]->id,
                'duration' => '2:17',
                'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-10.mp3',
                'cover_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&auto=format&fit=crop&q=80',
                'description' => 'High octane drums mixed with avant-garde jazz piano chords in Spanish regional fusion.',
                'lyrics' => "Chica, ¿qué dices? Saoko, papi, saoko! Cuando el caballo entra a Troya, tú te confías...",
                'is_new' => false,
                'plays_count' => 42000,
            ],
        ];

        $musics = [];
        foreach ($musicsData as $m) {
            $musics[$m['slug']] = Music::create($m);
        }

        // 8. Video Items (Ensure at least 5 have is_new = true for Latest 5 listings)
        $videosData = [
            // Video 1 (NEW)
            [
                'title' => 'Blinding Lights - Official 4K Cinema Cut',
                'slug' => 'blinding-lights-official-4k',
                'artist_id' => $artists['the-weeknd']->id,
                'album_id' => $albums['after-hours']->id,
                'genre_id' => $genres['pop']->id,
                'language_id' => $languages['EN']->id,
                'year_id' => $years[2026]->id,
                'duration' => '4:20',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=600&auto=format&fit=crop&q=80',
                'description' => 'High-speed Vegas night cruise in 4K HDR. Neo-noir cinematic visual storytelling.',
                'is_new' => true,
                'views_count' => 54300,
            ],
            // Video 2 (NEW)
            [
                'title' => 'Chaiyya Chaiyya - Live at Royal Albert Hall',
                'slug' => 'chaiyya-chaiyya-live-royal-albert',
                'artist_id' => $artists['ar-rahman']->id,
                'album_id' => $albums['dil-se']->id,
                'genre_id' => $genres['bollywood-film']->id,
                'language_id' => $languages['HI']->id,
                'year_id' => $years[2026]->id,
                'duration' => '7:15',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=600&auto=format&fit=crop&q=80',
                'description' => 'A.R. Rahman conducts 80-piece orchestra with traditional dhol players in London.',
                'is_new' => true,
                'views_count' => 78200,
            ],
            // Video 3 (NEW)
            [
                'title' => 'Physical & Levitating - Stadium Visualizer',
                'slug' => 'levitating-stadium-visualizer',
                'artist_id' => $artists['dua-lipa']->id,
                'album_id' => $albums['future-nostalgia']->id,
                'genre_id' => $genres['pop']->id,
                'language_id' => $languages['EN']->id,
                'year_id' => $years[2026]->id,
                'duration' => '3:50',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=80',
                'description' => 'Dazzling laser stage production filmed during Dua Lipa world stadium tour.',
                'is_new' => true,
                'views_count' => 32400,
            ],
            // Video 4 (NEW)
            [
                'title' => 'Born to Shine & G.O.A.T. - Live in Toronto',
                'slug' => 'goat-live-toronto',
                'artist_id' => $artists['diljit-dosanjh']->id,
                'album_id' => $albums['goat-album']->id,
                'genre_id' => $genres['hip-hop-rap']->id,
                'language_id' => $languages['PA']->id,
                'year_id' => $years[2026]->id,
                'duration' => '5:10',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=600&auto=format&fit=crop&q=80',
                'description' => 'Historical sold-out arena show featuring Punjabi folk fusion and electric crowd vibes.',
                'is_new' => true,
                'views_count' => 61000,
            ],
            // Video 5 (NEW)
            [
                'title' => 'Soul of Madras - Sid Sriram Unplugged',
                'slug' => 'soul-of-madras-unplugged',
                'artist_id' => $artists['sid-sriram']->id,
                'album_id' => $albums['midnight-melodies']->id,
                'genre_id' => $genres['classical-carnatic']->id,
                'language_id' => $languages['TA']->id,
                'year_id' => $years[2026]->id,
                'duration' => '4:45',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=600&auto=format&fit=crop&q=80',
                'description' => 'Intimate acoustic session overlooking the Bay of Bengal at twilight.',
                'is_new' => true,
                'views_count' => 28500,
            ],
            // Video 6 (Catalog / Classic)
            [
                'title' => 'Lose Yourself to Dance - Retro 70s Studio',
                'slug' => 'lose-yourself-to-dance-retro',
                'artist_id' => $artists['daft-punk']->id,
                'album_id' => $albums['random-access-memories']->id,
                'genre_id' => $genres['electronic-dance']->id,
                'language_id' => $languages['FR']->id,
                'year_id' => $years[2013]->id,
                'duration' => '4:11',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=600&auto=format&fit=crop&q=80',
                'description' => 'Sequined suits, pyramid risers, and Nile Rodgers signature Stratocaster rhythm.',
                'is_new' => false,
                'views_count' => 92000,
            ],
            // Video 7 (Catalog / Spanish)
            [
                'title' => 'Bizcochito - Moto Tour Visual Experience',
                'slug' => 'bizcochito-moto-tour',
                'artist_id' => $artists['rosalia']->id,
                'album_id' => $albums['motomami-deluxe']->id,
                'genre_id' => $genres['pop']->id,
                'language_id' => $languages['ES']->id,
                'year_id' => $years[2022]->id,
                'duration' => '3:12',
                'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/WeAreGoingOnBullrun.mp4',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&auto=format&fit=crop&q=80',
                'description' => 'Viral choreography and avant-garde Spanish pop stage aesthetic.',
                'is_new' => false,
                'views_count' => 47900,
            ],
        ];

        $videos = [];
        foreach ($videosData as $v) {
            $videos[$v['slug']] = Video::create($v);
        }

        // 9. Reviews & Ratings
        Review::create([
            'user_id' => $user1->id,
            'item_type' => 'music',
            'item_id' => $musics['blinding-lights-midnight-echoes']->id,
            'rating' => 5,
            'review_text' => 'Absolute perfection! The synth-wave bassline combined with Abel\'s vocal range gives me goosebumps every single time. Best track on the platform.',
        ]);

        Review::create([
            'user_id' => $user2->id,
            'item_type' => 'music',
            'item_id' => $musics['chaiyya-chaiyya-remaster']->id,
            'rating' => 5,
            'review_text' => 'A.R. Rahman\'s genius is unmatched! Hearing this remastered Dolby Atmos version brought tears to my eyes. The regional energy and Sufi poetry are timeless.',
        ]);

        Review::create([
            'user_id' => $user1->id,
            'item_type' => 'video',
            'item_id' => $videos['blinding-lights-official-4k']->id,
            'rating' => 5,
            'review_text' => 'The cinematography in this video looks like a full cinema movie. Amazing dark aesthetic and flawless color grading!',
        ]);

        Review::create([
            'user_id' => $user2->id,
            'item_type' => 'video',
            'item_id' => $videos['chaiyya-chaiyya-live-royal-albert']->id,
            'rating' => 5,
            'review_text' => 'The live orchestra energy is phenomenal! Huge salute to SOUND Group for hosting regional classics with such high fidelity video.',
        ]);

        Review::create([
            'user_id' => $user1->id,
            'item_type' => 'music',
            'item_id' => $musics['levitating-club-future-groove']->id,
            'rating' => 4,
            'review_text' => 'Super energetic pop anthem! Dua Lipa always delivers great club vibes.',
        ]);

        Review::create([
            'user_id' => $user2->id,
            'item_type' => 'music',
            'item_id' => $musics['kannana-kanne-acoustic-sunrise']->id,
            'rating' => 5,
            'review_text' => 'Sid Sriram\'s voice hits straight in the heart. The Carnatic flourishes on acoustic guitar are pure gold.',
        ]);

        // 10. Site Settings (SOUND Group details)
        $settings = [
            'site_name' => 'SOUND Group Entertainment',
            'site_tagline' => 'Global & Regional Audio-Visual Entertainment Portal',
            'about_title' => 'About SOUND Group Entertainment',
            'about_description' => 'SOUND Group is an international entertainment enterprise dedicated to celebrating musical and cinematic artistry across cultures. Our portal curates the finest collection of contemporary hits and historic gems in both Regional (Hindi, Tamil, Telugu, Punjabi, Spanish, French, Korean) and English languages. With state-of-the-art lossless audio streaming, 4K video playback, authentic community reviews, and deep categorization by Album, Artist, Year, Genre, and Language, SOUND Group empowers audiences worldwide to discover sound without borders.',
            'contact_email' => 'contact@soundgroup.com',
            'contact_phone' => '+1 (800) 555-SOUND',
            'contact_address' => 'SOUND Group Entertainment Tower, 500 Melody Way, Suite 100, Los Angeles, CA 90028, USA',
            'hero_headline' => 'Feel the Beat. Experience the Vision.',
            'hero_subheadline' => 'Stream new and legendary Music and Videos across Regional and English languages in stunning dark fidelity.',
            'announcement' => '🔥 NEW ADDITIONS: Check out the latest 5 Songs & 5 Videos flashing with exclusive releases!',
            'footer_text' => '© ' . date('Y') . ' SOUND Group Entertainment Inc. All Rights Reserved. Built with Laravel 11.',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::create([
                'key' => $key,
                'value' => $val,
                'description' => ucfirst(str_replace('_', ' ', $key)),
            ]);
        }
    }
}
