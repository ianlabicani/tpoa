<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::paginate(10);
        return view('guest.hotels.index', compact('hotels'));
    }




    public function show(Hotel $hotel)
    {
        return view('guest.hotels.show', compact('hotel'));
    }
}
