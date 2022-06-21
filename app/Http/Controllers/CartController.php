<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Auth;
use File;
use App\Models\User;
use App\Models\Cart;
class CartController extends Controller
{
    public function add_cart(Request $request){

        $request->validate([
            'product_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'product_image'=>'required',
            'product_image_url'=>'required',
        ]);

        $name = auth()->user()->firstName. ' '. auth()->user()->lastName;
        $cart = Cart::create([
            'uuid'=> auth()->user()->uuid,
            'user_name'=> $name,
            'product_id'=>$request->input('product_id'),
            'product_name'=>$request->input('product_name'),
            'product_price'=>$request->input('product_price'),
            'product_image'=>$request->input('product_image'),
            'product_image_url'=>$request->input('product_image_url'),
        ]);

        if($cart){
            return response()->json([
                'message' => 'Prooduct Successfully Added To Cart' ,
                'data' => $cart  
            ]);
        }

        return response()->json([
            'message' => 'failed'
        ]);

    }
}
