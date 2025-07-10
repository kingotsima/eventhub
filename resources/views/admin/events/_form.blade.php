<!-- @csrf

<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="type">Type</label>
    <select name="type" id="type" class="form-control" required>
        <option value="">-- Select Type --</option>
        <option value="Public Event" {{ old('type', $event->type ?? '') == 'Public Event' ? 'selected' : '' }}>Public Event</option>
        <option value="Private Event" {{ old('type', $event->type ?? '') == 'Private Event' ? 'selected' : '' }}>Private Event</option>
    </select>
</div>


<div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" class="form-control" value="{{ old('category', $event->category ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Date & Time</label>
    <input type="datetime-local" name="date_time" class="form-control" 
        value="{{ old('date_time', isset($event) ? \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i') : '') }}" required>
</div>

<div class="mb-3">
    <label>Venue</label>
    <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Capacity</label>
    <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $event->capacity ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Regular Price</label>
    <input type="number" name="regular_price" class="form-control" value="{{ old('regular_price', $event->regular_price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>VIP Price (Optional)</label>
    <input type="number" name="vip_price" class="form-control" value="{{ old('vip_price', $event->vip_price ?? '') }}">
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    @if(isset($event) && $event->image)
        <img src="{{ asset('storage/' . $event->image) }}" class="mt-2" width="150">
    @endif
</div>

<button type="submit" class="btn btn-success">Save</button> -->
