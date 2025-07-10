<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();

        $nextEvent = Event::where('date_time', '>', now())->orderBy('date_time')->first();

        $news = [];

        try {
            $response = Http::timeout(5)->get('https://newsapi.org/v2/everything', [
                'q' => 'events OR concert OR festival OR exhibition OR conference OR workshop OR seminar',
                'sortBy' => 'publishedAt',
                'language' => 'en',
                'pageSize' => 30,
                'apiKey' => config('services.newsapi.key'),
            ]);

            if ($response->successful()) {
                $fetched = $response['articles'];

                // Filter for more relevant event-related news
                $keywords = ['event', 'concert', 'festival', 'exhibition', 'conference', 'workshop', 'seminar'];

                $filteredNews = array_filter($fetched, function ($article) use ($keywords) {
                    $title = strtolower($article['title'] ?? '');
                    $description = strtolower($article['description'] ?? '');
                    foreach ($keywords as $keyword) {
                        if (strpos($title, $keyword) !== false || strpos($description, $keyword) !== false) {
                            return true;
                        }
                    }
                    return false;
                });

                $news = array_values($filteredNews);
            }
        } catch (\Exception $e) {
            Log::error('Failed to fetch news: ' . $e->getMessage());
            // You can also flash a session warning or pass an empty $news array silently
        }

        return view('welcome', compact('testimonials', 'nextEvent', 'news'));
    }
}
