<?php

namespace App\Services\Services;

use App\Http\Requests\ChatRequest;
use App\Jobs\SendNewMessageNotification;
use App\Models\Car;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use App\Services\Constructors\ChatConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatService implements ChatConstructor
{
    public function index()
    {
        $senderId = Auth::id();

        $messages = Message::where(function($query) use ($senderId) {
                $query->where('user_id', $senderId)
                      ->orWhere('receiver_id', $senderId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.chats.index', compact('messages'));
    }

    public function startChat($userName, $carId)
    {
        $car = Car::find($carId);
        if (!$car) {
            return back()->withErrors(['error' => 'Car not found']);
        }

        $user = User::where('name', $userName)->firstOrFail();

        $chat = Chat::where(function ($query) use ($user, $carId) {
                    $query->where('user_id', Auth::id())
                        ->where('receiver_id', $user->id)
                        ->where('car_id', $carId);
                })->orWhere(function ($query) use ($user, $carId) {
                    $query->where('user_id', $user->id)
                        ->where('receiver_id', Auth::id())
                        ->where('car_id', $carId);
                })->first();

        if (!$chat) {
            $chat = Chat::create([
                'user_id' => Auth::id(),
                'receiver_id' => $user->id,
                'car_id' => $carId,
                'username' => $user->name,
            ]);
        }

        $chat->load('user', 'receiver', 'car');
        $messages = $chat->messages()->orderBy('created_at', 'asc')->get();

        // Retrieve all chats for the current user
        $chats = Chat::where('user_id', Auth::id())
                     ->orWhere('receiver_id', Auth::id())
                     ->get();

        return view('pages.chats.start', compact('chat', 'messages', 'user', 'chats'));
    }

    public function show($userName, $carId)
    {
        $chat = Chat::firstOrCreate(
            ['username' => $userName, 'car_id' => $carId],
            ['user_id' => Auth::id()]
        );

        $userId = Auth::id();
        $carCreatorId = $chat->car->user_id;

        if ($userId !== $carCreatorId) {
            $messageSent = $chat->messages()->where('user_id', $userId)->exists();

            if ($messageSent) {
                $messages = $chat->messages()
                    ->where(function ($query) use ($userId, $carCreatorId) {
                        $query->where('user_id', $userId)
                            ->orWhere('user_id', $carCreatorId)
                            ->where('receiver_id', $userId);
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();
            } else {
                $messages = $chat->messages()
                    ->orderBy('created_at', 'asc')
                    ->get();
            }

            $users = User::where('id', $carCreatorId)->get();
        } else {
            $messages = $chat->messages()
                ->orderBy('created_at', 'asc')
                ->get();

            $users = User::whereIn('id', $chat->messages->pluck('user_id')->unique())->get();
        }

        return view('pages.chats.show', compact('chat', 'messages', 'users', 'messageSent'));
    }

    public function store(ChatRequest $request)
    {
        $request->validate();

        if (Auth::check()) {
            $userId = Auth::id();
            $carId = $request->car_id;
            $receiver = User::where('name', $request->username)->first();

            if ($receiver) {
                $existingChat = Chat::where('car_id', $carId)
                                    ->where(function ($query) use ($userId, $receiver) {
                                        $query->where('user_id', $userId)
                                              ->where('receiver_id', $receiver->id)
                                              ->orWhere('user_id', $receiver->id)
                                              ->where('receiver_id', $userId);
                                    })
                                    ->first();

                if ($existingChat) {
                    return redirect()->route('chats.show', ['chat' => $existingChat->id]);
                } else {
                    $chat = Chat::create([
                        'user_id' => $userId,
                        'receiver_id' => $receiver->id,
                        'car_id' => $carId,
                        'username' => $receiver->name,
                        'email' => Auth::user()->email
                    ]);

                    return redirect()->route('chats.show', ['chat' => $chat->id]);
                }
            }

            return back()->withErrors(['error' => 'Receiver not found']);
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
