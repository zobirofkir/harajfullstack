<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user_id', Auth::id())->with('car')->get();
        return view('pages.chats.index', compact('chats'));
    }

    public function show($userId, $carId)
    {
        $chat = Chat::where('user_id', $userId)
                    ->where('car_id', $carId)
                    ->firstOrCreate([
                        'user_id' => $userId,
                        'car_id' => $carId,
                    ]);

        $messages = $chat->messages()->with('user')->get();

        return view('pages.chats.show', compact('chat', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate(['car_id' => 'required|exists:cars,id']);

        $chat = Chat::firstOrCreate([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
        ]);

        return redirect()->route('pages.chats.show', $chat);
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate(['content' => 'required|string']);

        $chat->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back();
    }
}
