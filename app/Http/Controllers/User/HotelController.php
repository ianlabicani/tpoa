<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller

{

    public function index(Request $request)
    {
        $query = Hotel::query();

        // Apply search filter if search query is provided
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $hotels = $query->paginate(9); // Adjust number per page as needed

        return view('user.hotels.index', compact('hotels'));
    }



    public function show(Hotel $hotel)
    {
        return view('user.hotels.show', compact('hotel'));
    }
}
