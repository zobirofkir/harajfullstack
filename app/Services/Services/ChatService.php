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
        $userId = Auth::id();

        // Get all users except the current one
        $users = User::where('id', '!=', $userId)->get();

        // Get all chats where the logged-in user is either the sender or receiver
        $chats = Chat::with(['messages.user', 'car'])
                    ->whereHas('messages', function ($query) use ($userId) {
                        $query->where('user_id', $userId)
                              ->orWhere('receiver_id', $userId);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

        $usersWithMessageCount = $users->map(function ($user) use ($userId) {
            $messageCount = Chat::whereHas('messages', function ($query) use ($user, $userId) {
                $query->where(function ($q) use ($user, $userId) {
                    $q->where('user_id', $user->id)
                      ->where('receiver_id', $userId);
                })
                ->orWhere(function ($q) use ($user, $userId) {
                    $q->where('user_id', $userId)
                      ->where('receiver_id', $user->id);
                });
            })->count();

            $user->message_count = $messageCount;
            return $user;
        });

        return view('pages.chats.index', ['chats' => $chats, 'users' => $usersWithMessageCount]);
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
                        ->where('receiver_id', $carCreatorId);
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
