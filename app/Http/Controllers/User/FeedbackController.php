<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Feedback;
use App\Models\Feedbacks;
use App\Models\FeedbackReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $destination = Destination::findOrFail($request->destination);

        $destination->feedbacks()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);
        activity()->log('user added feedback');

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function edit(Destination $destination, Feedback $feedback)
    {
        // Check if the current user owns the feedback
        if ($feedback->user_id !== auth()->id()) {
            abort(403, 'You do not have permission to edit this feedback');
        }

        return view('user.feedbacks.edit', compact('destination', 'feedback'));
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
        activity()->log('user updated feedback');

        return redirect()->back()->with('success', 'Feedback updated successfully');
    }

    public function like(Request $request, $feedbackId)
    {
        $userId = auth()->id();

        // Check if the user has already reacted
        $existingReaction = FeedbackReaction::where('user_id', $userId)
            ->where('feedback_id', $feedbackId)
            ->first();

        if ($existingReaction) {
            if ($existingReaction->reaction === 'like') {
                return response()->json([
                    'message' => 'Already liked',
                    'reaction' => 'like',
                    'likes' => $this->getReactionCount($feedbackId, 'like'),
                    'dislikes' => $this->getReactionCount($feedbackId, 'dislike'),
                ], 200);
            }

            // Update the reaction
            $existingReaction->update(['reaction' => 'like']);
        } else {
            // Create a new reaction
            FeedbackReaction::create([
                'user_id' => $userId,
                'feedback_id' => $feedbackId,
                'reaction' => 'like',
            ]);
        }

        return $this->getReactionResponse($feedbackId);
    }

    public function dislike(Request $request, $feedbackId)
    {
        $userId = auth()->id();

        // Check if the user has already reacted
        $existingReaction = FeedbackReaction::where('user_id', $userId)
            ->where('feedback_id', $feedbackId)
            ->first();

        if ($existingReaction) {
            if ($existingReaction->reaction === 'dislike') {
                return response()->json([
                    'message' => 'Already disliked',
                    'reaction' => 'dislike',
                    'likes' => $this->getReactionCount($feedbackId, 'like'),
                    'dislikes' => $this->getReactionCount($feedbackId, 'dislike'),
                ], 200);
            }

            // Update the reaction
            $existingReaction->update(['reaction' => 'dislike']);
        } else {
            // Create a new reaction
            FeedbackReaction::create([
                'user_id' => $userId,
                'feedback_id' => $feedbackId,
                'reaction' => 'dislike',
            ]);
        }
        activity()->log('user reacted to feedback');

        return $this->getReactionResponse($feedbackId);
    }

    private function getReactionResponse($feedbackId)
    {
        $userId = Auth::id();
        $userReaction = FeedbackReaction::where('user_id', $userId)
            ->where('feedback_id', $feedbackId)
            ->value('reaction');

        return response()->json([
            'likes' => $this->getReactionCount($feedbackId, 'like'),
            'dislikes' => $this->getReactionCount($feedbackId, 'dislike'),
            'userReaction' => $userReaction,
        ], 200);
    }

    private function getReactionCount($feedbackId, $reaction)
    {
        return FeedbackReaction::where('feedback_id', $feedbackId)->where('reaction', $reaction)->count();
    }




}
