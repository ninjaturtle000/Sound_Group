<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicMediaTest extends TestCase
{
    public function test_uploaded_music_is_served_from_the_public_disk(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('music/test-track.mp3', 'test audio');

        $this->get('/storage/music/test-track.mp3')
            ->assertOk()
            ->assertHeader('content-type', 'audio/mpeg');
    }

    public function test_unapproved_or_missing_media_paths_are_not_served(): void
    {
        Storage::fake('public');

        $this->get('/storage/private/secret.txt')->assertNotFound();
        $this->get('/storage/music/missing.mp3')->assertNotFound();
    }
}
