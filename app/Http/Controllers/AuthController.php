<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //fonction d'enregistrement de l'utilisateur
    /**
     * @param  \Illuminate\Http\Request  $request 
     */
    public function register(Request $request){
        $fields = $request->validate([
            "name" => "required",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            "name" => $fields["name"],
            "email" => $fields["email"],
            "password" => bcrypt($fields["password"])
        ]);

        $token = $user->createToken("myappToken")->plainTextToken;

        $response = [
            "user" => $user,
            "token" => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $email = $fields["email"];
        $user= User::where('email', $email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => "These credentials do not match our records."
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
    }
}
