<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
 

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
            
            
            
            // Retrieve the authenticated user
    
            return response()->json([
                'user' => $user,
            ], 200);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function logout() 

    {
        Auth::logout();


        return response()->json(['message' => 'User logged out successfully'], 200);
    }
    
}
