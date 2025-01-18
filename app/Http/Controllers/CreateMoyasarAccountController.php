<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateMoyasarAccountController extends Controller
{
    public function activate(User $user)
    {
        return view('moyassar.packs');
    }
}
