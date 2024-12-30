<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Feedback;
use App\Models\Video;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        // Retrieve all destinations
        $destinations = Destination::paginate(10);

        return view('guest.destinations.index', compact('destinations'));
    }

    // Show the details of a specific destination
    public function show($id)
    {
        // Retrieve the destination by its ID
        $destination = Destination::withCount([
            'reactions as like_count' => function ($query) {
                $query->where('reaction', 'like');
            },
            'reactions as dislike_count' => function ($query) {
                $query->where('reaction', 'dislike');
            }
        ])->findOrFail($id);

        // Get related feedbacks and videos for the destination
        $feedbacks = $destination->feedback()->orderBy('created_at', 'desc')->paginate(5);
        $videos = $destination->videos()->orderBy('created_at', 'desc')->paginate(5);

        return view("guest.destinations.show", compact('destination', 'feedbacks', 'videos'));
    }
}
