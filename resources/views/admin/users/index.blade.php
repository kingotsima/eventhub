@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="users-admin">
    <div class="users-header">
        <h2 class="page-title">All Users</h2>
        <form class="search-form" method="GET" action="{{ route('admin.users.index') }}">
            <input type="text" name="search" placeholder="Search name/email..." value="{{ request('search') }}">
            <button type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <div class="users-table-wrapper">
        <table class="users-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="user-profile">
                            @if($user->profile_image)
                                <img src="{{ Storage::url($user->profile_image) }}" alt="Profile">
                            @else
                                <i class="bi bi-person-circle"></i>
                            @endif
                            <span>{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <span class="status-badge {{ $user->is_suspended ? 'suspended' : 'active' }}">
                            {{ $user->is_suspended ? 'Suspended' : 'Active' }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route($user->is_suspended ? 'admin.users.enable' : 'admin.users.suspend', $user) }}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            <button type="submit" class="action-btn {{ $user->is_suspended ? 'enable' : 'suspend' }}">
                                <i class="bi {{ $user->is_suspended ? 'bi-unlock' : 'bi-lock' }}"></i>
                                {{ $user->is_suspended ? 'Enable' : 'Suspend' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
/* Layout */
.users-admin {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.users-header {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 1rem;
}

/* Search Form */
.search-form {
    display: flex;
    gap: 0.5rem;
}

.search-form input {
    padding: 0.5rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    min-width: 250px;
}

.search-form button {
    padding: 0.5rem 1rem;
    background: #4f46e5;
    color: white;
    border: none;
    border-radius: 4px;
}

/* Table Styles */
.users-table-wrapper {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.users-table {
    width: 100%;
    border-collapse: collapse;
}

.users-table th {
    padding: 1rem;
    text-align: left;
    background: #f8fafc;
    font-weight: 600;
}

.users-table td {
    padding: 1rem;
    border-bottom: 1px solid #edf2f7;
}

/* User Profile */
.user-profile {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-profile img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
}

/* Status Badges */
.status-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-badge.active {
    background: #dcfce7;
    color: #166534;
}

.status-badge.suspended {
    background: #fee2e2;
    color: #991b1b;
}

/* Action Buttons */
.action-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    font-size: 0.8rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.action-btn.enable {
    background: #dcfce7;
    color: #166534;
}

.action-btn.suspend {
    background: #fee2e2;
    color: #991b1b;
}

/* Dark Mode */
body.dark-mode .users-table-wrapper {
    background: var(--dark-card);
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

body.dark-mode .users-table th {
    background: var(--dark-header);
    color: var(--dark-text);
}

body.dark-mode .users-table td {
    border-color: var(--dark-border);
    color: var(--dark-text);
}

body.dark-mode .search-form input {
    background: var(--dark-input);
    color: var(--dark-text);
    border-color: var(--dark-border);
}
</style>
@endsection