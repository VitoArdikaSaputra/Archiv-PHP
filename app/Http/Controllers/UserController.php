<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function userProfile(Request $request)
    {

    }
    protected function createuser(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'mimes:jpeg,jpg,png|max:10000',
            'name' => 'required|string|max:144',
            'username' => 'required|string|max:36',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|mix:8'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $user = User::create([
            'photo' => $validator['photo'],
            'name' => $validator['name'],
            'username' => $validator['username'],
            'email' =>$validator['email'],
            'password' => Hash::make($validator['password'])            
        ]); 

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    // function index(Request $request){
    //     $user= User::where('email', $request->email)->first();
    //     if(!$user || Hash::check($request->password, $user->password)){
    //         return response([
    //             'message' => ['Undefined Credentials']
    //         ], 404);

    //         $token = $user->createToken('opat-arsip-digital')->plainTextToken;

    //         $response = [
    //             'message' => 'Welcome',
    //             'user' => $user,
    //             'token' => $token,
    //         ];
            
    //         return response()->json($response, 201);
    //     }
    // }

    // function store(Request $request){
    //     $user = new User([
    //         'name' => $request->name,
    //         'email' => $request->request,
    //         'password' => Hash::make($request->password),
    //         'access_levels' => $request->access_levels
    //     ]);

    //     $user->save();
    //     return response()->json(['message' => 'User telah ditambahkan'], 200);
    // }
}
