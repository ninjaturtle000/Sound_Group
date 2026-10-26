@extends('layouts.app')

@section('title', 'Register New Account - SOUND Group')

@section('content')
<div class="main-wrapper" style="max-width: 650px;">

    <div class="glass-panel" style="padding: 2.5rem; margin-top: 1rem; margin-bottom: 3rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon" style="margin: 0 auto 1rem; width: 44px; height: 44px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
            </div>
            <h1 style="font-size: 2.2rem; margin-bottom: 0.5rem;">Create Your Account</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                Join SOUND Group Entertainment to stream, review, and rate music and videos.
            </p>
            <div style="margin-top: 0.75rem; display: inline-block; background: rgba(244, 63, 94, 0.15); color: #fda4af; font-size: 0.78rem; font-weight: 700; padding: 3px 12px; border-radius: 9999px; border: 1px solid rgba(244, 63, 94, 0.3);">
                * All fields (USERID, Name, Email, Phone, Address, Password) are MANDATORY
            </div>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Unique USERID Field -->
            <div class="form-group">
                <label class="form-label">
                    USERID (Unique Username) <span class="required-mark">*</span>
                </label>
                <input type="text" name="userid" value="{{ old('userid') }}" class="form-control @error('userid') is-invalid @enderror" placeholder="e.g. musiclover99" required autocomplete="username">
                <div class="form-text-muted">Must be globally unique. Only letters, numbers, dashes, and underscores.</div>
                @error('userid')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Full Name Field -->
            <div class="form-group">
                <label class="form-label">
                    Full Name <span class="required-mark">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Alexander Rivera" required autocomplete="name">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email-id Field -->
            <div class="form-group">
                <label class="form-label">
                    Email-id <span class="required-mark">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="name@domain.com" required autocomplete="email">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div class="form-group">
                <label class="form-label">
                    Phone Number <span class="required-mark">*</span>
                </label>
                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g. +1 555-019-2834" required autocomplete="tel">
                <div class="form-text-muted">Format: digits, spaces, dashes, parentheses or leading +.</div>
                @error('phone')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Physical Address Field -->
            <div class="form-group">
                <label class="form-label">
                    Address <span class="required-mark">*</span>
                </label>
                <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror" placeholder="Street, Suite/Apt, City, State/Province, Country, Postal Code" required autocomplete="street-address">{{ old('address') }}</textarea>
                @error('address')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Fields -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">
                        Password <span class="required-mark">*</span>
                    </label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 6 characters" required autocomplete="new-password">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Confirm Password <span class="required-mark">*</span>
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-type password" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem; font-size: 1rem; margin-top: 1rem;">
                Create SOUND Group Account
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.9rem; color: var(--text-muted);">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700;">Sign in here</a>
        </div>
    </div>

</div>
@endsection
