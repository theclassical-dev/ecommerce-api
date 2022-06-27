<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Auth;
use File;
use App\Models\Product;
use App\Models\User;
use DB;

class ProductController extends Controller
{
    public function getAllProduct(){

        // $products = Product::all()->first();
        $gals = DB::select("SELECT * FROM products ORDER BY id");

        $results = [];
    
        foreach($gals as $gal){
            // $gal->avater = env('APP_URL') . '/storage/productAvater/' . $gal->avater;
            $gal->avater = Storage::disk('public')->url('productAvater/'.$gal->avater);
            array_push($results, $gal);
        } 
        return response()->json($results);
        // foreach($products as $p){

        // $imgRes = [
        //     "image_url" => Storage::disk('public')->url('productAvater/'.$p->avater),
        //     // "mime" => $p->avater->getClientMimeType()
        // ];

    // }
        // if($products){
        //     return response()->json([
        //         'data' => $products,
        //         "image_url" => Storage::disk('public')->url('productAvater/'.$products->avater),

        //     ]);
        // }

        // $results = [];
        // $ds = explode('|', $products->images);
        // foreach($ds as $d){

        // }





        // if(!$products->isEmpty()){
        //     foreach($products as $p){
        //         $p->images = env('App_URL') .'/storage/productImages/'.$p->images;

        //         // $p->Storage::disk('public')->url('productAvater/');
        //         array_push($results, $p);
        //         // $ds = explode('|', $d->pictures ?? '');

        //     }
            
        //     return response()->json([
        //         // 'data' => $results
        //         'data' => [
        //             'images'=> implode(',', $results)
        //         ]
        //     ]);
        // }
        // return response()->json([
        //     'message' => 'no products is available'
        // ]);

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
