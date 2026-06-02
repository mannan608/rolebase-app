<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function index()
{
    $events = Event::latest()->paginate(12);
    //  dd($events);

    return view('frontend.pages.events.index', compact('events'));
}
    public function show($slug)
{
    $event = Event::where('slug', $slug)
        ->firstOrFail();

    // Increase view count
    $event->increment('views');

    // Latest events except current one
    $latestEvents = Event::where('id', '!=', $event->id)
        ->latest()
        ->take(5)
        ->get();

    return view('frontend.pages.events.show', [
        'event' => $event,
        'latestEvents' => $latestEvents,
    ]);
}
}
