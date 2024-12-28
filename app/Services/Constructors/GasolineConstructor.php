<?php
namespace App\Services\Constructors;

interface GasolineConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index() : array;

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return array
     */
    public function show(int $id) : array;
}
