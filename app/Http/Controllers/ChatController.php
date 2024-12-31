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
        $chats = Chat::where('username', request()->username)->with('car')->get();
        return view('pages.chats.index', compact('chats'));
    }

    public function show($userName, $carId)
    {
        $chat = Chat::where('username', $userName)
                    ->where('car_id', $carId)
                    ->firstOrCreate([
                        'username' => $userName,
                        'car_id' => $carId,
                    ]);

        $messages = $chat->messages()->get();

        return view('pages.chats.show', compact('chat', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'username' => 'required|string|max:255',
        ]);

        $chat = Chat::firstOrCreate([
            'username' => $request->username,
            'car_id' => $request->car_id,
        ]);

        return redirect()->route('chats.show', ['userName' => $request->username, 'carId' => $request->car_id]);
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate(['content' => 'required|string']);

        $chat->messages()->create([
            'username' => $chat->car->user->name,
            'content' => $request->content,
        ]);

        return back();
    }
}
