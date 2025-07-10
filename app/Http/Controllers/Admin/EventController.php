<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'category' => 'required|string',
            'description' => 'required',
            'venue' => 'required|string',
            'date_time' => 'required|date',
            'regular_price' => 'required|numeric',
            'vip_price' => 'nullable|numeric',
            'vvip_price' => 'nullable|numeric', // ✅ Add VVIP
            'capacity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'category' => 'required|string',
            'description' => 'required',
            'venue' => 'required|string',
            'date_time' => 'required|date',
            'regular_price' => 'required|numeric',
            'vip_price' => 'nullable|numeric',
            'vvip_price' => 'nullable|numeric', // ✅ Add VVIP
            'capacity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete(); // This now soft deletes the event
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }
}
