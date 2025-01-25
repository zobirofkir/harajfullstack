<?php
namespace App\Services\Constructors;

use App\Http\Requests\ChatRequest;
use App\Models\Chat;
use Illuminate\Http\Request;

interface ChatConstructor
{
    public function index();

    public function show($userName, $carId);

    public function store(ChatRequest $request);

    public function sendMessage(Request $request, Chat $chat);
}
