<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Services\Facades\LogoFacade;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function show(int $id)
    {
        $logo = Logo::findOrFail($id);
        $cars = $logo->cars;
        return view('pages.logos.show', compact('logo', 'cars'));
    }
}
