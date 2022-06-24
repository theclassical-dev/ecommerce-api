<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;

class CategoryController extends Controller
{
    public function get_all_category(){

        $category = Category::all();

        if(!$category->isEmpty()){
            return response()->json(['data' => $category]);
        }
            return response()->json(['message' => 'no category is avaliable']);


    }
}
