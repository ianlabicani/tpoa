<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Feedback;
use App\Models\Hotel;
use App\Models\Video;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();
    
        // Apply search filter if search query is provided
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $destinations = $query->paginate(9); // Adjust number per page as needed
    
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
        $feedbacks = $destination->feedbacks()->orderBy('created_at', 'desc')->paginate(5);
        $videos = $destination->videos()->orderBy('created_at', 'desc')->paginate(5);

        if (auth()->check()) {
            // return redirect()->route('user.destinations.show', [$destination, $feedbacks, $videos]);
            return view('user.destinations.show', compact('destination', 'feedbacks', 'videos'));
        }
        // dd('test');
        return view("guest.destinations.show", compact('destination', 'feedbacks', 'videos'));
    }


   
}
