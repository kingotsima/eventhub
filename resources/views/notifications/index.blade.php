@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">All Notifications</h3>
    <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
        @csrf
        <button type="submit" class="btn btn-sm btn-primary mb-3">Mark All as Read</button>
    </form>
    <ul class="list-group">
        @forelse ($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $notification->data['message'] ?? 'Notification' }}</strong>
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @if (is_null($notification->read_at))
                    <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-success">Mark as Read</button>
                    </form>
                @endif
            </li>
        @empty
            <li class="list-group-item text-muted">You have no notifications</li>
        @endforelse
    </ul>

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('form[action*="/notifications/"][method="post"]').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // prevent default form submission

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (res.ok) {
                        location.reload(); // reload to reflect the read status
                    } else {
                        console.error("Error marking as read");
                    }
                })
                .catch(err => console.error(err));
            });
        });
    });
</script>
@endpush
