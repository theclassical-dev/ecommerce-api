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

    public function add_category(Request $request){

        $request->validate(['name']);

        $category = Category::create(['name' => $request->input('name')]);
        if($category){
            return response()->json(['message' => 'category successfully added']);
        }
            return response()->json(['message' => 'failed']);

    }
}
