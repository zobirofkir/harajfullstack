<?php
namespace App\Services\Services;

use App\Models\Gasoline;
use App\Services\Constructors\GasolineConstructor;

class GasolineService implements GasolineConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $gasolines = Gasoline::all();
        return [
            'gasolines' => $gasolines
        ];
    }

    /**
     * Show the specified resource in storage.
     *
     * @param integer $id
     * @return array
     */
    public function show(int $id): array
    {
        $gasoline = Gasoline::findOrFail($id);
        return [
            'gasoline' => $gasoline
        ];
    }
}
