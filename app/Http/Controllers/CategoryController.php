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

    public function addCategory(Request $request){

        $request->validate(['name']);

        $category = Category::create(['name' => $request->input('name')]);
        if($category){
            return response()->json([
                'message' => 'category successfully added',
                'data' => $category
            ]);
        }
            return response()->json(['message' => 'failed']);

    }

    public function updateCategory(Request $request, $id){
        $request->validate(['name']);

        $category = Category::find($id);
        if($category){
            return response()->json([
                'message' => 'successfully updated',
                'data' => $category
            ]);
        }
    }
}
