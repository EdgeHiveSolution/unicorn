<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgressChat;
use App\Models\Progress;


class ProgressChatApiController extends Controller

{
    

    public function index(Progress $progress)
{
    // Fetch all ProgressChat messages related to the specified progress
    $progressChats = ProgressChat::where('progress_id', $progress->id)->get();

    // Return a JSON response with the progress chat messages
    return response()->json(['data' => $progressChats]);
}


public function store(Request $request)
{
    
    // Validate the incoming request
    $request->validate([
        'progress_id' => 'required|exists:progress,id',
        'sender_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

    // Create a new ProgressChat instance
    $progressChat = ProgressChat::create($request->all());

    // Return a JSON response with the newly created chat message
    return response()->json($progressChat, 201);
}


// Retrieve a specific progress chat message
// public function show($id)
// {
//     $progressChat = ProgressChat::find($id);

//     if (!$progressChat) {
//         return response()->json(['message' => 'Progress chat not found'], 404);
//     }

//     return response()->json(['data' => $progressChat]);
// }


// ProgressChatController.php
public function getComments(Progress $progress)
{
    // Fetch all ProgressChat messages related to the specified progress, ordered by creation timestamp in descending order
    $progressChats = ProgressChat::where('progress_id', $progress->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Return a JSON response with the progress chat messages
    return response()->json(['data' => $progressChats]);
}



// ProgressChatController.php
public function update(Request $request, ProgressChat $progressChat)
{
    // Validate the incoming request
    $request->validate([
        'message' => 'required|string',
    ]);

    // Update the message field of the ProgressChat
    $progressChat->update(['message' => $request->input('message')]);

    // Return a JSON response with the updated progress chat message
    return response()->json($progressChat);
}


// ProgressChatController.php
public function destroy(ProgressChat $progressChat)
{
    // Delete the specified ProgressChat message
    $progressChat->delete();

    // Return a JSON response indicating success
    return response()->json(['message' => 'Progress chat message deleted']);
}



// // Delete a progress chat message
// public function destroy($id)
// {
//     $progressChat = ProgressChat::find($id);

//     if (!$progressChat) {
//         return response()->json(['message' => 'Progress chat not found'], 404);
//     }

//     $progressChat->delete();

//     return response()->json(['message' => 'Progress chat deleted successfully']);
// }

// Retrieve a list of progress chat messages
// Retrieve a list of the latest progress chat messages
// public function index()
// {
//     $progressChats = ProgressChat::orderBy('created_at', 'desc')->get();

//     return response()->json(['data' => $progressChats]);
// }


}
