<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EventController extends Controller
{
    /**
     * Display a listing of events with optional filtering.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if ($filter === 'past') {
            // Show only soft-deleted (past) events
            $events = Event::onlyTrashed()
                ->orderBy('date_time', 'desc')
                ->paginate(6);
        } elseif ($filter === 'all') {
            // Get upcoming (non-deleted) and past (soft-deleted) events
            $upcoming = Event::where('date_time', '>=', now())
                ->orderBy('date_time', 'asc')
                ->get();

            $past = Event::onlyTrashed()
                ->orderBy('date_time', 'desc')
                ->get();

            // Merge both and sort by date_time descending
            $allEvents = $upcoming->merge($past)->sortByDesc('date_time');

            // Manually paginate
            $page = $request->get('page', 1);
            $perPage = 6;
            $paginated = new LengthAwarePaginator(
                $allEvents->forPage($page, $perPage),
                $allEvents->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            $events = $paginated;
        } else {
            // Show only upcoming events (not soft-deleted)
            $events = Event::where('date_time', '>=', now())
                ->orderBy('date_time', 'asc')
                ->paginate(6);
        }

        return view('events.index', compact('events', 'filter'));
    }

    /**
     * Search for events based on query string.
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        if (!$query) {
            return redirect()->route('events.index')->with('error', 'Please enter a search term.');
        }

        $events = Event::where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('location', 'like', '%' . $query . '%')
                  ->orWhere('category', 'like', '%' . $query . '%');
            })
            ->whereNull('deleted_at') // Exclude soft-deleted
            ->orderBy('date_time', 'asc')
            ->paginate(6);

        return view('events.index', [
            'events' => $events,
            'searchQuery' => $query,
            'filter' => null,
        ]);
    }

    /**
     * Display a single event's details.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
