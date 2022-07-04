<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;

class Authcontroller extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'userName' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $c = random_bytes(3);
        $uuid = strtoupper((bin2hex($c)));

        $user = User::create([
            'uuid' => $uuid,
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'userName' => $data['userName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $user =  User::where('email', $data['email'])->first();

        //check password
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response(['message' => 'check the inserted details'], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function editDetails(Request $request, $id){

        $user = auth()->user()->find($id);

        if($user){
            $user->update($request->all());
            // return UserResource::collection($user);
            return response()->json([
                'message' =>'Record updated successfully',
                'data' =>$user
            ], 200);
        }

        return response()->json(['message' =>'error updating details ...']);
    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();

        return [
            'message' => 'logged out'
        ];
    }
}
