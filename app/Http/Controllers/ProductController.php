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

        // if(!$products->isEmpty()){
        //     return response()->json([
        //         'data' => $products
        //     ]);
        // }

        $results = [];
        if(!$products->isEmpty()){
            // foreach($products as $p){
            //     $p->image = env('App_URL') .'/storage/productAvater/'.$p->avater;

            //     $p->Storage::disk('public')->url('productAvater/')
            //     array_push($results, $p);
            // }
            return response()->json([
                // 'data' => $results
                'data' => $products
            ]);
        }
        return response()->json([
            'message' => 'no products is avaliable'
        ]);

    }

    public function addProduct(Request $request){

        $request->validate([
            'name'=>'required|unique:products,name',
            'price'=>'required',
            'discount'=>'required',
            'description'=>'required',
            'quantity'=>'required',
            'status'=>'required',
            'category'=>'required',
            'avater'=>'required',
            // 'images'=>'required',
        ]);

        //single image 'product avater'

        $img = $request->file('avater');
        if($request->hasFile('image')){
            $file = rand(11111, 99999).'.'.$img->getClientOriginalExtension();
            $img->storeAs('productAvater',$file, 'public');
        }

        //multiple images 'product images

        $imgs = $request->file('images');
        $imgName = array();

        if($request->hasFile('images')){

           foreach($imgs as $img){
            $file = rand(11111, 99999).'.'.$img->getClientOriginalExtension();
            $img->storeAs('productImages',$file, 'public');
            $imgName[] = $file;
            } 
        }
        
        $imgDb = $imgName;
        
        //create product
        $product = Product::create([
            'name'=> $request->input('name'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('discription'),
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status'),
            'category' => $request->input('category'),
            'avater' => $file,
            'images' =>implode(',', $imgName)
        ]);

        if($product){

            return response()->json([
                'message' => 'Product Successfully Added'
            ]);
        }

            return response()->json(['message' => 'failed']);

        // notification purpose
            // images
            $images = [
                "image_url" => Storage::disk('public')->url('productImages/'.$imgName),
                "mime" => $imgs->getClientMimeType()
            ];

            //single
            $avater = [
                "image_url" => Storage::disk('public')->url('/productAvater'.$file),
                "mime" => $img->getClientMimeType()
            ];
    }

    public function updateProduct(Request $request, $id){

        $product = Product::find($id);

        if($product){

        }
    }

    public function deleteProduct($id){
        $product = Product::find($id);

        if($product){
            
        }
    }

}
