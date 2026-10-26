@extends('layouts.admin')

@section('title', 'Manage Users & Logins - Admin')

@section('content')
<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; margin: 0;">User Accounts & Logins</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Manage registered users, roles (Administrator / User), and account access status.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            + Create New User Account
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="glass-panel" style="padding: 1.25rem; margin-bottom: 2rem;">
        <form action="{{ route('admin.users.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by USERID, name, email, or phone..." class="form-control" style="flex: 1; min-width: 260px;">
            <select name="role" class="form-control" style="width: auto;">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Standard User</option>
            </select>
            <button type="submit" class="btn-primary">Search</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Reset</a>
        </form>
    </div>

    <!-- Users Table -->
    <div class="glass-panel" style="overflow-x: auto; padding: 0.5rem;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>USERID</th>
                    <th>Full Name</th>
                    <th>Email-id</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Reviews</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <strong style="color: #38bdf8;">{{ $user->userid }}</strong>
                            @if($user->id === auth()->id())
                                <span style="font-size: 0.65rem; background: rgba(16,185,129,0.2); color: #34d399; padding: 1px 5px; border-radius: 4px; margin-left: 4px;">YOU</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #fff;">{{ $user->name }}</div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td style="font-size: 0.8rem; color: var(--text-dim); max-width: 180px;">{{ Str::limit($user->address, 30) }}</td>
                        <td>
                            <span class="badge-tag" style="background: {{ $user->role === 'admin' ? 'rgba(139,92,246,0.2)' : 'rgba(255,255,255,0.06)' }}; color: {{ $user->role === 'admin' ? '#c4b5fd' : '#cbd5e1' }}; font-weight: 700;">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td>{{ $user->reviews_count }}</td>
                        <td>
                            <form action="{{ route('admin.users.toggle-active', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer;" title="Click to toggle status" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <span style="color: {{ $user->is_active ? '#34d399' : '#f43f5e' }}; font-size: 0.82rem; font-weight: 700;">
                                        {{ $user->is_active ? '● Active' : '○ Disabled' }}
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-secondary" style="font-size: 0.78rem; padding: 0.35rem 0.75rem;">
                                    Edit
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete user \'{{ $user->userid }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-danger" style="font-size: 0.78rem; padding: 0.35rem 0.75rem;">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 3rem; color: var(--text-dim);">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: center; margin-top: 1.5rem;">
        {{ $users->links() }}
    </div>
</div>
@endsection
