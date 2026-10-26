@extends('layouts.app')

@section('title', 'Sign In - SOUND Group')

@section('content')
<div class="main-wrapper" style="max-width: 520px;">

    <div class="glass-panel" style="padding: 2.5rem; margin-top: 2rem; margin-bottom: 3rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon" style="margin: 0 auto 1rem; width: 44px; height: 44px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
            </div>
            <h1 style="font-size: 2.2rem; margin-bottom: 0.5rem;">Welcome Back</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                Sign in with your USERID or Email to continue streaming and reviewing.
            </p>
        </div>

        <!-- Quick Demo Credentials Fill -->
        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem;">
            <div style="font-size: 0.78rem; font-weight: 700; color: #a78bfa; text-transform: uppercase; margin-bottom: 0.5rem;">
                🚀 Quick Demo Credentials (1-Click Fill)
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <button type="button" class="btn-secondary" style="flex: 1; justify-content: center; font-size: 0.8rem; padding: 0.45rem;" onclick="fillLogin('admin', 'admin123')">
                    👑 Administrator
                </button>
                <button type="button" class="btn-secondary" style="flex: 1; justify-content: center; font-size: 0.8rem; padding: 0.45rem;" onclick="fillLogin('johndoe', 'user123')">
                    👤 Standard User
                </button>
            </div>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Login Input (USERID or Email) -->
            <div class="form-group">
                <label class="form-label">
                    USERID or Email-id <span class="required-mark">*</span>
                </label>
                <input type="text" id="loginField" name="login" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" placeholder="Enter username or email" required autofocus autocomplete="username">
                @error('login')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label class="form-label">
                    Password <span class="required-mark">*</span>
                </label>
                <input type="password" id="passwordField" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required autocomplete="current-password">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                <label style="display: flex; align-items: center; gap: 6px; font-size: 0.85rem; color: var(--text-muted); cursor: pointer;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Keep me signed in</span>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem; font-size: 1rem;">
                Sign In to SOUND Group
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.9rem; color: var(--text-muted);">
            Don't have an account yet? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 700;">Create one here</a>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function fillLogin(user, pass) {
        document.getElementById('loginField').value = user;
        document.getElementById('passwordField').value = pass;
    }
</script>
@endpush
@endsection
