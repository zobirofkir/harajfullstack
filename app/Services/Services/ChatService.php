<?php

namespace App\Services\Services;

use App\Http\Requests\ChatRequest;
use App\Jobs\SendNewMessageNotification;
use App\Models\Chat;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use App\Services\Constructors\ChatConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatService implements ChatConstructor
{
    public function index()
    {
        $chats = Chat::with('messages.user')->orderBy('created_at', 'desc')->get();

        return view('pages.chats.index', compact('chats'));
    }

    public function show($userName, $carId)
    {
        $chat = Chat::firstOrCreate(
            ['username' => $userName, 'car_id' => $carId]
        );

        $userId = Auth::id();
        $carCreatorId = $chat->car->user_id;

        if ($userId !== $carCreatorId) {
            $messages = $chat->messages()
                ->where(function ($query) use ($userId, $carCreatorId) {
                    $query->where('user_id', $userId)
                        ->orWhere('user_id', $carCreatorId)
                        ->where('receiver_id', $userId);
                })
                ->orderBy('created_at', 'asc')
                ->get();

            $users = User::where('id', $carCreatorId)->get();
        } else {
            $messages = $chat->messages()
                ->orderBy('created_at', 'asc')
                ->get();

            $users = User::whereIn('id', $chat->messages->pluck('user_id')->unique())->get();
        }

        return view('pages.chats.show', compact('chat', 'messages', 'users'));
    }

    public function store(ChatRequest $request)
    {
        $request->validate();

        if (Auth::check()) {
            $chat = Chat::firstOrCreate([
                'user_id' => Auth::id(),
                'username' => $request->username,
                'car_id' => $request->car_id,
                'email' => Auth::user()->email
            ]);

            return redirect()->route('chats.show', ['userName' => $request->username, 'carId' => $request->car_id]);
        }

        return redirect()->route('login');
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate(['content' => 'required|string']);

        if (Auth::check()) {
            $receiver = User::where('name', $chat->username)->first();

            if ($receiver) {
                $message = $chat->messages()->create([
                    'user_id' => Auth::id(),
                    'receiver_id' => $receiver->id,
                    'username' => Auth::user()->name,
                    'content' => $request->content,
                    'email' => Auth::user()->email
                ]);

                SendNewMessageNotification::dispatch($message);

                return back();
            }

            return back()->withErrors(['error' => 'Receiver not found']);
        }

        return redirect()->route('login');
    }
}
