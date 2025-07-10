@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Event: {{ $event->title }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" 
                                   value="{{ old('title', $event->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-control" required>
                                <option value="">-- Select Type --</option>
                                <option value="Public Event" {{ old('type', $event->type) == 'Public Event' ? 'selected' : '' }}>
                                    Public Event
                                </option>
                                <option value="Private Event" {{ old('type', $event->type) == 'Private Event' ? 'selected' : '' }}>
                                    Private Event
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" 
                                   value="{{ old('category', $event->category) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date & Time</label>
                            <input type="datetime-local" name="date_time" class="form-control" 
                                   value="{{ old('date_time', \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i')) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control" 
                                   value="{{ old('venue', $event->venue) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacity</label>
                            <input type="number" name="capacity" class="form-control" 
                                   value="{{ old('capacity', $event->capacity) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Regular Price (₦)</label>
                            <input type="number" name="regular_price" class="form-control" 
                                   value="{{ old('regular_price', $event->regular_price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">VIP Price (₦) - Optional</label>
                            <input type="number" name="vip_price" class="form-control" 
                                   value="{{ old('vip_price', $event->vip_price) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">VVIP Price (₦) - Optional</label>
                            <input type="number" name="vvip_price" class="form-control" 
                                value="{{ old('vvip_price', $event->vvip_price) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Event Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($event->image)
                        <div class="mt-2">
                            <span class="text-muted">Current Image:</span>
                            <img src="{{ asset('storage/' . $event->image) }}" class="img-thumbnail mt-1" width="150">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection