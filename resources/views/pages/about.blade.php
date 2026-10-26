@extends('layouts.app')

@section('title', 'About SOUND Group Entertainment')

@section('content')
<div class="main-wrapper">
    <div style="max-width: 960px; margin: 0 auto;">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; margin-bottom: 1rem;">
                Official Entertainment Portal
            </div>
            <h1 style="font-size: 3.2rem; margin-bottom: 1rem;">{{ $settings['about_title'] }}</h1>
            <p style="font-size: 1.15rem; color: var(--text-muted); max-width: 680px; margin: 0 auto; line-height: 1.7;">
                Pioneering the next generation of audio-visual media by bridging regional folklore with international contemporary hits.
            </p>
        </div>

        <!-- Main Narrative Card -->
        <div class="glass-panel" style="padding: 2.5rem; margin-bottom: 2.5rem;">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.25rem; color: #fff;">Our Mission & Vision</h2>
            <p style="color: #cbd5e1; line-height: 1.8; font-size: 1.02rem; margin-bottom: 1.5rem;">
                {{ $settings['about_description'] }}
            </p>
            <p style="color: #cbd5e1; line-height: 1.8; font-size: 1.02rem;">
                At SOUND Group, we believe music and video are universal languages. Whether it is a vintage 1990s Hindi Bollywood melody by A.R. Rahman, a contemporary Punjabi trap anthem by Diljit Dosanjh, a soulful Tamil Carnatic acoustic performance by Sid Sriram, or global pop hits by The Weeknd and Dua Lipa — every creation is treated with equal sonic prestige and artistic respect.
            </p>
        </div>

        <!-- Pillar Features -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <div class="glass-panel" style="padding: 2rem;">
                <div style="font-size: 2.2rem; margin-bottom: 1rem;">🌐</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: #fff;">Regional & English Languages</h3>
                <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6;">
                    Curated catalogs supporting English alongside Regional languages including Hindi, Tamil, Telugu, Punjabi, Spanish, French, and Korean.
                </p>
            </div>

            <div class="glass-panel" style="padding: 2rem;">
                <div style="font-size: 2.2rem; margin-bottom: 1rem;">⭐</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: #fff;">Community Reviews & Ratings</h3>
                <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6;">
                    Registered listeners can rate from 1 to 5 stars, submit in-depth critique, and modify their reviews at any time.
                </p>
            </div>

            <div class="glass-panel" style="padding: 2rem;">
                <div style="font-size: 2.2rem; margin-bottom: 1rem;">⚡</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: #fff;">Dynamic "NEW" Additions</h3>
                <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6;">
                    Flashing animated badges instantly highlight fresh additions, ensuring music lovers never miss the latest singles or video drops.
                </p>
            </div>
        </div>

        <!-- Contact & Corporate Information -->
        <div class="glass-panel" style="padding: 2.5rem;">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; color: #fff;">Corporate Headquarters & Contact</h2>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2rem;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--primary); margin-bottom: 0.4rem;">Address</div>
                    <div style="font-size: 0.95rem; color: #e2e8f0; line-height: 1.6;">
                        {{ $settings['contact_address'] }}
                    </div>
                </div>

                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--primary); margin-bottom: 0.4rem;">Customer Support</div>
                    <div style="font-size: 0.95rem; color: #e2e8f0; line-height: 1.6;">
                        Email: <a href="mailto:{{ $settings['contact_email'] }}" style="color: #38bdf8;">{{ $settings['contact_email'] }}</a><br>
                        Phone: {{ $settings['contact_phone'] }}
                    </div>
                </div>

                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--primary); margin-bottom: 0.4rem;">Hours of Operation</div>
                    <div style="font-size: 0.95rem; color: #e2e8f0; line-height: 1.6;">
                        24/7 Digital Streaming<br>
                        Editorial Desk: Mon - Fri, 9am - 6pm PST
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
