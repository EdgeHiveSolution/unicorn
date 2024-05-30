<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Construct the controller and apply the 'auth' middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the authenticated user matches the requested user
        if ($user->id == $id) {
            // Show the profile
            return view('profile.show', ['user' => $user]);
        }

        // If the authenticated user does not match the requested user, you can handle the unauthorized access here
        abort(403, 'Unauthorized access.');
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
   
     public function update(Request $request, string $id)
{
    // Validate the request data
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're accepting image files
        'new_password' => 'nullable|string|min:6|confirmed', // password_confirmation field must match

       
    ]);

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

    return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
