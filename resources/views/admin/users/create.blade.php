@extends('layouts.admin')

@section('title', 'Create User Account - Admin')

@section('content')
<div style="max-width: 750px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Create New User Account</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">All fields (USERID, Name, Email, Phone, Address, Password) are mandatory.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
            &larr; Back to Users
        </a>
    </div>

    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <!-- Unique USERID -->
            <div class="form-group">
                <label class="form-label">USERID (Unique Username) <span class="required-mark">*</span></label>
                <input type="text" name="userid" value="{{ old('userid') }}" class="form-control" placeholder="e.g. soundcurator" required>
                <div class="form-text-muted">Must be globally unique. Letters, numbers, dashes, and underscores only.</div>
            </div>

            <!-- Full Name -->
            <div class="form-group">
                <label class="form-label">Full Name <span class="required-mark">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Sarah Jenkins" required>
            </div>

            <!-- Email & Phone -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Email-id <span class="required-mark">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="sarah@example.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number <span class="required-mark">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+1 555-019-3388" required>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label class="form-label">Address <span class="required-mark">*</span></label>
                <textarea name="address" rows="2" class="form-control" placeholder="Full residential or commercial address" required>{{ old('address') }}</textarea>
            </div>

            <!-- Role & Password -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Account Role <span class="required-mark">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Standard USER</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Password <span class="required-mark">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem; margin-top: 1rem;">
                Create User & Login
            </button>
        </form>
    </div>

</div>
@endsection
