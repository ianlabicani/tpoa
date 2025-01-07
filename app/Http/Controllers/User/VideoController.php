<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'video_title' => 'required|string|max:255',
            'video_url' => 'required|string|max:5000',
            'video_description.*' => 'nullable|string',
            'yt_embed_link' => 'nullable|string|max:255',
        ]);

        $destination = Destination::findOrFail($request->destination);

        $destination->videos()->create([
            'title' => $request->video_title,
            'url' => $request->video_url,
            'isReviewed' => false,
            'description' => $request->video_description,
            'user_id' => auth()->id(),
        ]);


        return redirect()->back()->with('success', 'Destination created successfully.');
    }


    public function update(Request $request, $destinationId, $videoId)
    {
        $video = Video::where('destination_id', $destinationId)->findOrFail($videoId);

        if ($video->user_id !== auth()->id()) {
            return redirect()->route('user.destinations.show', $destinationId)->with('error', 'You are not authorized to edit this video.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:5000',
            'description' => 'nullable|string',
        ]);

        $video->update([
            'title' => $validated['title'],
            'url' => $validated['url'],
            'description' => $validated['description'],
            'isReviewed' => false,
        ]);

        return redirect()->route('user.destinations.show', $destinationId)->with('success', 'Video updated and submitted for review.');
    }


}
