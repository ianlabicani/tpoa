<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $destination = Destination::findOrFail($request->destination);

        $destination->feedback()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function edit(Destination $destination, Feedback $feedback)
    {
        // Check if the current user owns the feedback
        if ($feedback->user_id !== auth()->id()) {
            abort(403, 'You do not have permission to edit this feedback');
        }

        return view('user.feedback.edit', compact('destination', 'feedback'));
    }

    // Update the feedback in the database
    public function update(Request $request, Destination $destination, Feedback $feedback)
    {
        // Validate the feedback input
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // Check if the current user owns the feedback
        if ($feedback->user_id !== auth()->id()) {
            abort(403, 'You do not have permission to update this feedback');
        }

        // Update the feedback
        $feedback->update([
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Feedback updated successfully');
    }


}
