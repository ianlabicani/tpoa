<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        // Fetch all videos
        $videos = Video::all();
        return view("admin.videos.index", compact("videos"));
    }

    public function review($id)
    {
        $video = Video::findOrFail($id);
        $video->isReviewed = true;
        $video->save();
        activity()->log('admin reviewed video');

        return redirect()->route('admin.videos.index')->with('success', 'Video marked as reviewed.');
    }

    // Method to store a new video
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'destination_id' => 'required|exists:destinations,id', // Make sure the destination exists
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string|max:500',
        ]);

        // Create a new video and set 'approved' to true
        Video::create([
            'destination_id' => $request->destination_id,
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'approved' => true, // Automatically approve the video
        ]);

        activity()->log('admin added a new video');

        return redirect()->route('admin.videos.index')->with('success', 'Video created and approved successfully!');
    }
}
