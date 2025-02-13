<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
 /**
 * Display a listing of hotels.
 */
public function index(Request $request)
{
    $query = Hotel::query();

    // Apply search filter if search query is provided
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $hotels = $query->paginate(9); // Adjust number per page as needed

    return view('guest.hotels.index', compact('hotels'));
}


    /**
     * Display the specified hotel details.
     */
    public function show(Hotel $hotel)
    {
        return view('guest.hotels.show', compact('hotel'));
    }
}
