<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request) {
        $data = $request->validated();
        $user = $request->user();

        $review = review::create([
            'user_id' => $user->id,
            'seller_id' => $data['seller_id'],
            'product_id' => $data['product_id'],
            'review' => $data['review'],
            'rating' => $data['rating'],
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Review created successfully',
            'data' => new ReviewResource($review),
        ]);
    }
    
}
