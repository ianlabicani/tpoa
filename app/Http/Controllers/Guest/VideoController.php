<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function showDestinationVideos()
    {
        $videos = Video::with('destination')
            ->where('isReviewed', true)
            ->get()
            ->unique('destination_id');

        // Return the view with the videos data


        return view('guest.videos.index', compact('videos'));
    }
}
