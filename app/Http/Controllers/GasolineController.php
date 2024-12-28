<?php

namespace App\Http\Controllers;

use App\Services\Facades\GasolineFacade;
use Illuminate\Http\Request;

class GasolineController extends Controller
{
    /**
     * List of gasolines
     *
     * @return void
     */
    public function index()
    {
        $gasolines = GasolineFacade::index()['gasolines'];

        return view('pages.gasolines.index', compact('gasolines'));
    }

    /**
     * Show a specific gasoline
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $gasoline = GasolineFacade::show($id)['gasoline'];

        return view('pages.gasolines.show', compact('gasoline'));
    }
}
