<?php

namespace App\Services\Services;

use App\Events\MessageSent;
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
        $userId = Auth::id();

        $messages = Message::where(fn($q) =>
                $q->where('user_id', $userId)
                  ->orWhere('receiver_id', $userId))
            ->whereHas('chat', fn($q) => $q->whereNotNull('car_id'))
            ->with(['user', 'receiver', 'chat.car'])
            ->latest()
            ->get();

        $conversations = $messages->groupBy(fn($msg) => $msg->chat->car_id);

        $conversationsWithUsers = $conversations->map(fn($msgs) => [
            'senders' => $msgs->pluck('user')->merge($msgs->pluck('receiver'))
                ->unique('id')
                ->reject(fn($user) => $user->id === $userId)
                ->values(),
            'messages' => $msgs->sortByDesc('created_at')
        ]);

        return view('pages.chats.index', compact('conversationsWithUsers'));
    }

    public function startChat($userName, $carId)
    {
        $userId = Auth::id();

        $chat = Chat::firstOrCreate(
            ['username' => $userName, 'car_id' => $carId],
            ['user_id' => $userId]
        );

        $user = User::where('name', $userName)->firstOrFail();
        $car = Car::findOrFail($carId);

        $isCreator = $car->user_id === $userId;

        $users = $isCreator
            ? Chat::where('car_id', $carId)->with(['user', 'receiver'])->get()->pluck('user', 'receiver')->flatten()->unique('id')
            : User::where('id', $car->user_id)->get();

        $messages = Message::where(function ($query) use ($userId, $user) {
                $query->where('user_id', $userId)->where('receiver_id', $user->id);
            })
            ->orWhere(fn($query) => $query->where('user_id', $user->id)->where('receiver_id', $userId))
            ->whereHas('chat', fn($q) => $q->where('car_id', $carId))
            ->with(['user', 'receiver'])
            ->oldest()
            ->get();

        return view('pages.chats.start', compact('messages', 'users', 'user', 'car', 'chat', 'isCreator'));
    }

    public function show($userName, $carId)
    {
        $userId = Auth::id();

        $chat = Chat::firstOrCreate(
            ['username' => $userName, 'car_id' => $carId],
            ['user_id' => $userId]
        );

        $carCreatorId = $chat->car->user_id;
        $isNotCreator = $userId !== $carCreatorId;

        $messages = $chat->messages()
            ->when($isNotCreator, function ($query) use ($userId, $carCreatorId) {
                $query->where(fn($q) => $q->where('user_id', $userId)
                                         ->orWhere('user_id', $carCreatorId)
                                         ->where('receiver_id', $userId));
            })
            ->oldest()
            ->get();

        $users = $isNotCreator
            ? User::find($carCreatorId)
            : User::whereIn('id', $chat->messages->pluck('user_id')->unique())->get();

        $messageSent = $isNotCreator ? $chat->messages()->where('user_id', $userId)->exists() : null;

        return view('pages.chats.show', compact('chat', 'messages', 'users', 'messageSent'));
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $receiver = User::where('name', $chat->username)->first();

        if (!$receiver) {
            return back()->withErrors(['error' => 'Receiver not found']);
        }

        $message = $chat->messages()->create([
            'user_id' => Auth::id(),
            'receiver_id' => $receiver->id,
            'username' => Auth::user()->name,
            'email' => Auth::user()->email,
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message));

        SendNewMessageNotification::dispatch($message);

        return back();
    }
}
