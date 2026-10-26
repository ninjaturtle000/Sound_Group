@extends('layouts.admin')

@section('title', 'Edit User - ' . $user->userid)

@section('content')
<div style="max-width: 750px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">Edit User Account</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Update user information, access roles, or activate/deactivate account.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
            &larr; Back to Users
        </a>
    </div>

    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">USERID (Unique Username)</label>
                <input type="text" value="{{ $user->userid }}" class="form-control" disabled style="opacity: 0.6; cursor: not-allowed;">
            </div>

            <div class="form-group">
                <label class="form-label">Full Name <span class="required-mark">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Email-id <span class="required-mark">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number <span class="required-mark">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Address <span class="required-mark">*</span></label>
                <textarea name="address" rows="2" class="form-control" required>{{ old('address', $user->address) }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                <div class="form-group">
                    <label class="form-label">Account Role <span class="required-mark">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Standard USER</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Reset Password (Leave blank to keep)</label>
                    <input type="password" name="password" class="form-control" placeholder="New password...">
                </div>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid var(--border-color); border-radius: 10px; padding: 1rem; margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #10b981;">
                    <div>
                        <div style="font-weight: 700; color: #fff;">Account Active & Enabled</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">Uncheck to suspend user's access to reviews and login.</div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="padding: 0.85rem 2rem; font-size: 1rem;">
                Save User Updates
            </button>
        </form>
    </div>

</div>
@endsection
