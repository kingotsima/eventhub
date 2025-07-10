@extends('layouts.admin')

@section('content')
<div class="admin-events-container">
    <div class="events-header">
        <h2 class="events-title">Manage Events</h2>
        <a href="{{ route('admin.events.create') }}" class="btn-create-event">
            <span>+</span> Create New Event
        </a>
    </div>

    <div class="events-table-container">
        <table class="events-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date/Time</th>
                    <th>Venue</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Regular Price</th>
                    <th>VIP Price</th>
                    <th>VVIP Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td class="event-title">{{ $event->title }}</td>
                    <td class="event-datetime">{{ $event->date_time }}</td>
                    <td class="event-venue">{{ $event->venue }}</td>
                    <td class="event-type">{{ $event->type }}</td>
                    <td class="event-category">{{ $event->category }}</td>
                    <td class="event-price">₦{{ number_format($event->regular_price) }}</td>
                    <td class="event-price">{{ $event->vip_price ? '₦'.number_format($event->vip_price) : '-' }}</td>
                    <td class="event-price">{{ $event->vvip_price ? '₦'.number_format($event->vvip_price) : '-' }}</td>
                    <td>
                        <div class="event-actions">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .admin-events-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .events-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .events-title {
        font-size: 1.8rem;
        color: #2d3748;
        font-weight: 600;
    }

    .btn-create-event {
        background-color: #4f46e5;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-create-event:hover {
        background-color: #4338ca;
    }

    .events-table-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    .events-table {
        width: 100%;
        border-collapse: collapse;
    }

    .events-table thead {
        background-color: #f7fafc;
    }

    .events-table th,
    .events-table td {
        padding: 1rem;
        border-bottom: 1px solid #edf2f7;
        text-align: left;
        vertical-align: middle;
    }

    .event-actions {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: nowrap; /* Force single row */
    }


    .event-actions form {
        display: inline;
        margin: 0;
    }

    .btn-edit,
    .btn-delete {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .btn-edit {
        background-color: #f59e0b;
        color: white;
    }

    .btn-edit:hover {
        background-color: #d97706;
    }

    .btn-delete {
        background-color: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background-color: #dc2626;
    }

    /* Dark mode */
    body.dark-mode .admin-events-container {
        background-color: var(--dark-bg);
    }

    body.dark-mode .events-title {
        color: var(--dark-text);
    }

    body.dark-mode .events-table-container {
        background-color: var(--dark-card);
    }

    body.dark-mode .events-table thead {
        background-color: var(--dark-header);
    }

    body.dark-mode .events-table th,
    body.dark-mode .events-table td {
        color: var(--dark-text);
        border-color: var(--dark-border);
    }

    body.dark-mode .event-title {
        color: var(--dark-text);
    }

    body.dark-mode .btn-edit {
        background-color: #d97706;
    }

    body.dark-mode .btn-delete {
        background-color: #b91c1c;
    }

    body.dark-mode .events-table tbody tr:hover {
        background-color: rgba(30, 64, 175, 0.2);
    }
</style>
@endsection
