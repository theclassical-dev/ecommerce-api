<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;
use App\Models\User;
use App\Models\Cart;
use App\Models\Upload;

class UserController extends Controller
{
    public function index(){
        return Auth::user()->upload;
    }

    public function getDetails(){
        $user = Auth::user()->detail;

        if($user->isEmpty()){

            return [
                'message' => 'no details'
            ];
        }
        return $user;
    }

    public function dUpload($id) {

        $d = auth()->user()->upload()->find($id);

        $path = public_path('storage/uploads/'.$d->image);
        $imgs = explode(',', $path);

        if($d){
            foreach($imgs as $img) {

                unlink($img);
                $d->delete($img);
                return [
                    'message' => 'Deleted'
                ];
            }
        }

        return [
            'message' => 'not found'
        ];
    }

    public function updateUpload(Request $request, $id){
        $d = auth()->user()->upload()->find($id);

        $path = public_path('storage/uploads/'.$d->image);
        $imgs = explode(',', $path);
        
        if($d){
            foreach($imgs as $img) {

                unlink($img);
                $d->update([
                  'image' => $path,
                ]);
                return [
                    'message' => $img
                ];
            }
        }
    }

   public function getCart(Request $request){
    
        $cart = auth()->user()->cart;

        if(!$cart->isEmpty()){

            return response()->json([
                'data' => $cart
            ]);
        }

        return response()->json([
            'message'=>'cart is empty'
        ]);

   }
}
