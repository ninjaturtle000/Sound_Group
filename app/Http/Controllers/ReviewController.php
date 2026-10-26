<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Review;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store or Modify a Review & Rating
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_type' => 'required|in:music,video',
            'item_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|min:3|max:2000',
        ], [
            'rating.required' => 'Please select a star rating between 1 and 5.',
            'rating.min' => 'Rating must be at least 1 star.',
            'rating.max' => 'Rating cannot exceed 5 stars.',
            'review_text.required' => 'Please provide your review feedback.',
            'review_text.min' => 'Review must be at least 3 characters long.',
        ]);

        // Validate item existence
        if ($request->item_type === 'music') {
            $item = Music::findOrFail($request->item_id);
        } else {
            $item = Video::findOrFail($request->item_id);
        }

        // Add or Modify existing review
        $review = Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'item_type' => $request->item_type,
                'item_id' => $request->item_id,
            ],
            [
                'rating' => $request->rating,
                'review_text' => $request->review_text,
            ]
        );

        $action = $review->wasRecentlyCreated ? 'submitted' : 'updated';

        return back()->with('success', "Your {$request->rating}-star review has been {$action} successfully!");
    }

    /**
     * Delete a review
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Check ownership or admin
        if ($review->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return back()->with('success', 'Your review has been deleted.');
    }
}
