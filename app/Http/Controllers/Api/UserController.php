<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




class UserController extends Controller

{
   
    
    public function getUserWithRelatedData(Request $request)
    {
                // Get the authenticated user
            $user = Auth::user();

            // Load the user with its related data
            Log::info('User with Related Data:', ['user' => $user]);

            return response()->json(['user' => $user]);
            }
}
