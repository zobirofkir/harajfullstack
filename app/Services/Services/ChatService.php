<?php
namespace App\Services\Services;

use App\Http\Requests\ChatRequest;
use App\Jobs\SendNewMessageNotification;
use App\Models\Chat;
use App\Notifications\NewMessageNotification;
use App\Services\Constructors\ChatConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatService implements ChatConstructor
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
            $message = $chat->messages()->create([
                'user_id' => Auth::id(),
                'username' => Auth::user()->name,
                'content' => $request->content,
                'email' => Auth::user()->email
            ]);

            SendNewMessageNotification::dispatch($message);

            return back();
        }

        return redirect()->route('login');
    }
}
