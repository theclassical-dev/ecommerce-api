<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Auth;
use File;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function getAllProduct(){

            $products = Product::all();

            if(!$products->isEmpty()){
                return response()->json([
                    'data' => $products
                ]);
            }

            return response()->json([
                'message' => 'no products is avaliable'
            ]);
    }
}
