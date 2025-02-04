<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Services\Facades\ChatFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        DB::table('messages')->update(['read' => true]);

        return ChatFacade::index();
    }

    public function startChat($userName, $carId)
    {
        return ChatFacade::startChat($userName, $carId);
    }

    public function show($userName, $carId)
    {
        return ChatFacade::show($userName, $carId);
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        return ChatFacade::sendMessage($request, $chat);
    }
}
