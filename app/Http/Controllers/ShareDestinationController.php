<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class ShareDestinationController extends Controller
{
    public function share(Request $request)
    {
        $destination = Destination::find($request->destination);

        if ($destination) {
            $destination->share_count += 1;
            $destination->save();
            return response()->json(['message' => 'Share count incremented successfully.']);
        }

        return response()->json(['message' => 'Destination not found.'], 404);
    }
}
