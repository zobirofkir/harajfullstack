<?php

namespace App\Services\Constructors;

use App\Models\Chat;
use Illuminate\Http\Request;

interface ChatConstructor
{
    public function index();

    public function startChat($userName, $carId);

    public function show($userName, $carId);

    public function sendMessage(Request $request, Chat $chat);
}
