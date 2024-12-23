<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view("admin.videos.index", compact("videos"));
    }

    public function review($id)
    {
        $video = Video::findOrFail($id);
        $video->isReviewed = true;
        $video->save();
        return redirect()->route('admin.videos.index')->with('success', 'Video marked as reviewed.');
    }
}
