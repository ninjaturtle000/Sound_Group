<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Artists
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });

        // 2. Genres
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color')->nullable()->default('#10B981');
            $table->timestamps();
        });

        // 3. Languages
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code', 10);
            $table->enum('type', ['english', 'regional'])->default('regional');
            $table->timestamps();
        });

        // 4. Years
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 5. Albums
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('artist_id')->constrained('artists')->cascadeOnDelete();
            $table->foreignId('genre_id')->nullable()->constrained('genres')->nullOnDelete();
            $table->foreignId('year_id')->nullable()->constrained('years')->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->integer('release_year')->nullable();
            $table->timestamps();
        });

        // 6. Musics
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('artist_id')->constrained('artists')->cascadeOnDelete();
            $table->foreignId('album_id')->nullable()->constrained('albums')->nullOnDelete();
            $table->foreignId('genre_id')->constrained('genres')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();
            $table->foreignId('year_id')->constrained('years')->cascadeOnDelete();
            $table->string('duration')->nullable()->default('3:30');
            $table->text('audio_url'); // Can be local path in /storage/music/... or URL
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->text('lyrics')->nullable();
            $table->boolean('is_new')->default(true);
            $table->unsignedInteger('plays_count')->default(0);
            $table->timestamps();
        });

        // 7. Videos
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('artist_id')->constrained('artists')->cascadeOnDelete();
            $table->foreignId('album_id')->nullable()->constrained('albums')->nullOnDelete();
            $table->foreignId('genre_id')->constrained('genres')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();
            $table->foreignId('year_id')->constrained('years')->cascadeOnDelete();
            $table->string('duration')->nullable()->default('4:00');
            $table->text('video_url'); // Video file path or embed link
            $table->string('thumbnail_image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_new')->default(true);
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
        });

        // 8. Reviews & Ratings
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('item_type'); // 'music' or 'video'
            $table->unsignedBigInteger('item_id');
            $table->unsignedTinyInteger('rating'); // 1 to 5
            $table->text('review_text');
            $table->timestamps();

            $table->unique(['user_id', 'item_type', 'item_id']);
            $table->index(['item_type', 'item_id']);
        });

        // 9. Site Settings
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('musics');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('years');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('artists');
    }
};
