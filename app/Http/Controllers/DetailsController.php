<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;

class DetailsController extends Controller
{
    public function getAllDetails(Request $request){
        $details = Detail::all();
        if($details != null) {
            return $details;
        }else{
            return ["no details"];
        }
    }

    public function createDetail(Request $request){
        $request->validate([
            'name' => 'required',
            'state' => 'required',
            'address' => 'required',
        ]);

          return Detail::create($request->all());
    }

    public function getDetail($id){
        $d = Detail::find($id);

        return $d;
    }

    public function updateDetail(Request $request, $id) {
        $d = Detail::find($id);
        $d->update($request->all());
        return $d;
    }

    public function searchDetail($name){
        $d = Detail::where('name', 'like', '%'.$name.'%')->get();
        return $d;
    }

    public function deleteDetail($id) {
        $d = Detail::find($id);
        $d->delete($id);
        return [
            
            'success' => $d,
        ];
    }

    public function deleteAll(Detail $detial) {
        $d = $detial->truncate();

        return [
            'success' => $d,
        ];
    }
}