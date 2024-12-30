<?php

namespace App\Http\Controllers;

use App\Services\Facades\LogoFacade;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function show(int $id)
    {
        $data = LogoFacade::show($id);
        $logo = $data['logo'];
        $cars = $data['cars'];
        return view('pages.logos.show', compact('logo', 'cars'));
    }
}
