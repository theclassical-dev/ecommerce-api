<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function getReview($id){

        $p = Product::find($id);
        $review = $p->review;
        if(!$review->isEmpty()){

            return response()->json(['data' => $review]);
        }
            return response()->json(['message' => 'no review avaliable']);

    }

    public function addReview(Request $request){
        $request->validate([
            'description' => 'required',
            'product_id' => 'required'
        ]);

        
        $review = Review::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->input('product_id'),
            'ticket' => '#'.rand(11111, 99999),
            'name' => auth()->user()->userName,
            'description' => $request->input('description'),
            'date' => now()
        ]);

        if($review){

            return response()->json([
                'message' => 'successfully added',
                'data' => $review
            ]);
        }

        return response()->json(['message' => 'failed']);
    }

    public function deleteReview(Request $request, $id){

        // $request->validate(['id' => 'required']);

        $review = auth()->user()->review()->find($id);

        if($review){
            $review->delete($review);
            return response()->json(['message' => 'Review Successfully Deleted']);
        }

        return response()->json(['message' => 'Not Avaliable']);

    }
}
