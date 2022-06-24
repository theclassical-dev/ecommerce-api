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
}
