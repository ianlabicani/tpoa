<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Video;
use App\Models\Event;
use App\Models\Hotel;

class SearchController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');

    $destinations = Destination::where('name', 'LIKE', "%$query%")
        ->orWhere('location', 'LIKE', "%$query%")
        ->orWhere('contact', 'LIKE', "%$query%")
        ->orWhere('how_to_get_there', 'LIKE', "%$query%")
        ->paginate(5, ['*'], 'destinations');

    $videos = Video::where('title', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->paginate(5, ['*'], 'videos');

    $events = Event::where('name', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->paginate(5, ['*'], 'events');

        $hotels = Hotel::where('name', 'LIKE', "%$query%")
        ->orWhere('location', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->paginate(5, ['*'], 'hotels');

    return view('admin.search-results', compact('query', 'destinations', 'videos', 'events', 'hotels'));
}

}
