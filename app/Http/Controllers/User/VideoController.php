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
            'video_title.*' => 'required|string|max:255',
            'video_url.*' => 'required|url',
            'video_description.*' => 'nullable|string',
        ]);

        $destination = Destination::findOrFail($request->destination);

        foreach ($request->video_title as $index => $title) {
            $destination->videos()->create([
                'title' => $title,
                'url' => $request->video_url[$index],
                'isReviewed' => false,
                'description' => $request->video_description[$index],
                'user_id' => auth()->id(),
            ]);
        }

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
            'url' => 'required|url',
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
