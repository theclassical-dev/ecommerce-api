<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Http\Resources\UserResource;

class AdminController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:admins,email',
            'password' => 'required|string|'
        ]);

        $c = random_bytes(2);
        $uuid = 'AD'.strtoupper((bin2hex($c)));

        $admin = Admin::create([
            'uuid' => $uuid,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $admin->createToken('adminToken')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // check admin email
        $admin = Admin::where('email', $data['email'])->first();

        if(!$admin || !Hash::check($data['password'], $admin->password)){
            return response(['message' => 'not found']);
        }

        $token = $admin->createToken('adminToken')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function logout(Request $request){
        auth()->guard('admin')->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function getAdmin(Request $request){
        return auth()->guard('admin')->user()->email;
    }

    public function getUser(Request $request){

        return UserResource::collection(User::all());
    }
}
