<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Upload;


class UploadController extends Controller
{
    public function getImages(){
        return Upload::all();
    }

    public function uploadSingle(Request $request){

        $request->validate([
            'image' => 'required',
        ]);

        $img = $request->file('image');
        if($request->hasFile('image')){
            $file = rand().'.'.$img->getClientOriginalName();
            $img->storeAs('uploads',$file, 'public');
        }

        return Upload::create([
            'image' => $file,
        ]);
    }

    public function upload(Request $request){

        $imgs = $request->file('image');
        $imgName = array();

        if($request->hasFile('image')){

           foreach($imgs as $img){
            $file = rand().'.'.$img->getClientOriginalExtension();
            $img->storeAs('uploads',$file, 'public');
            $imgName[] = $file;
            } 
        }
        
        $imgDb = $imgName;

        return Upload::create([
                'image' => implode(',', $imgName),
                'user_id' => auth()->user()->id,
                ]);
       
    }

    public function dUpload($id){

            $request->validate([
                'id' => 'required',
            ]);
            $del = Upload::find($id);
            $img = explode('|', $del->image);
            if($del){
                foreach($img as $imgs){
                    unlink('public/storage/uploads/'.$imgs);
                }
                $del->delete($del);
                return response()->json(['message' => 'Image deleted successfully']);
            }else{
                return response()->json(['message' => 'Image not found']);

            }
    }


    // for the display of the

        // @php
		// 	$d = DB::table('prop_pictures')->where('id', 1)->first();
		// 	$ds = explode('|', $d->pictures);
		// @endphp
		// @foreach ($ds as $f)
		// 	<image src="{{URL::to('public/storage/uploads/'.$f)}}" alt="" style="height: 50px; width: 50px" />
		// 	<br>
		// @endforeach

}
