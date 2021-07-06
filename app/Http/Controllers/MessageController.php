<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index(Request $request)
    {
        $messages = Message::query()
            ->paginate($request->query('limit', 10));

        return response()->json($messages);
    }

    public function show(Message $message)
    {
        return response()->json($message);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:180'],
            'email' => ['required', 'string', 'email', 'max:180'],
            'message' => ['required', 'string', 'max:500'],
        ]);

        $message = Message::create($request->only(['name', 'email', 'message']));

        return response()->json($message, 201);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return response()->noContent();
    }

}
