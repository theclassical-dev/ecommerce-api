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
            'quantity' => 'required',
            'product_image'=>'required',
            'product_image_url'=>'required',
        ]);

        $name = auth()->user()->firstName. ' '. auth()->user()->lastName;
        $total = $request->input('product_price') * $request->input('quantity');

        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'uuid'=> auth()->user()->uuid,
            'user_name'=> $name,
            'product_id'=>$request->input('product_id'),
            'product_name'=>$request->input('product_name'),
            'product_price'=>$request->input('product_price'),
            'quantity'=>$request->input('quantity'),
            'total' => $total,
            'product_image'=>$request->input('product_image'),
            'product_image_url'=>$request->input('product_image_url'),
        ]);

        if($cart){
            return response()->json([
                'message' => 'Product Successfully Added To Cart' ,
                'data' => $cart  
            ]);
        }

        return response()->json([
            'message' => 'failed'
        ]);

    }

    public function update_cart(Request $request, $id){

        $cart  = auth()->user()->cart()->find($id);
        $total = $request->input('product_price') * $request->input('quantity');
        // $total = $cart->discount * $cart->quantity;
        
        if($cart){

            $cart->update([
                'product_id'=>$request->get('product_id'),
                'product_name'=>$request->get('product_name'),
                'product_price'=>$request->get('product_price'),
                'quantity' => $request->get('quantity'),
                'total' => $total,
                'product_image'=>$request->get('product_image'),
                'product_image_url'=>$request->get('product_image_url'),
            ]);

            return response()->json(['data' => $cart]);
        }

            return response()->json(['message' => 'record not found']);
    }

    public function delete_cart($id){

        $cart = auth()->user()->cart()->find($id);

        if($cart){

            $cart->delete($cart);
            return response()->json(['message' => 'cart removed']);
        }

            return response()->json(['message' => 'The cart is not Avaliable ']);
    }
}
