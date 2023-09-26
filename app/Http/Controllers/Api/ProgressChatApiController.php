<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgressChat;


class ProgressChatApiController extends Controller

{
    // Create a new progress chat message
public function store(Request $request)
{
    $validatedData = $request->validate([
        'progress_id' => 'required|exists:progress,id',
        'sender_id' => 'required|exists:users,id', // If you have a User model
        'recipient_id' => 'required|exists:users,id', // If you have a User model
        'message' => 'required|string',
    ]);

    $progressChat = ProgressChat::create($validatedData);

    return response()->json(['message' => 'Progress chat created successfully', 'data' => $progressChat], 201);
}

// Retrieve a specific progress chat message
public function show($id)
{
    $progressChat = ProgressChat::find($id);

    if (!$progressChat) {
        return response()->json(['message' => 'Progress chat not found'], 404);
    }

    return response()->json(['data' => $progressChat]);
}

// Update a progress chat message
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'progress_id' => 'exists:progress,id',
        'sender_id' => 'exists:users,id', // If you have a User model
        'recipient_id' => 'exists:users,id', // If you have a User model
        'message' => 'string',
    ]);

    $progressChat = ProgressChat::find($id);

    if (!$progressChat) {
        return response()->json(['message' => 'Progress chat not found'], 404);
    }

    $progressChat->update($validatedData);

    return response()->json(['message' => 'Progress chat updated successfully', 'data' => $progressChat]);
}

// Delete a progress chat message
public function destroy($id)
{
    $progressChat = ProgressChat::find($id);

    if (!$progressChat) {
        return response()->json(['message' => 'Progress chat not found'], 404);
    }

    $progressChat->delete();

    return response()->json(['message' => 'Progress chat deleted successfully']);
}

// Retrieve a list of progress chat messages
// Retrieve a list of the latest progress chat messages
public function index()
{
    $progressChats = ProgressChat::orderBy('created_at', 'desc')->get();

    return response()->json(['data' => $progressChats]);
}


}
