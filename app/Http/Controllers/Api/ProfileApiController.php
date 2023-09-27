<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileApiController extends Controller
{

    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function updateProfile(Request $request, string $id): JsonResponse
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're accepting image files
        'new_password' => 'nullable|string|min:6|confirmed', // password_confirmation field must match
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Retrieve the authenticated user
    $user = Auth::user();
    // Update user properties
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Update the profile photo if a new one is provided
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = strtolower($user->name) . "-profile-photo" . time() . '.' . $photo->getClientOriginalExtension();
        $destinationPath = public_path('/profile-photos/');
        $photo->move($destinationPath, $photoName);

        // Update the user's photo attribute with the new file name
        $user->photo = $photoName;
    }

    // Update the password if a new one is provided
    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->input('new_password'));
    }

    // Save the user
    $user->save();

    return response()->json(['message' => 'Profile updated successfully'], 200);
}

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
