<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(9);
        return view("user.destinations.index", compact("destinations"));
    }

    public function show(Destination $destination)
    {
        $feedbacks = $destination->feedback()->orderBy('created_at', 'desc')->paginate(5);
        $videos = $destination->videos()->orderBy('created_at', 'desc')->paginate(5);
        return view("user.destinations.show", compact('destination', 'feedbacks', 'videos'));
    }
}
