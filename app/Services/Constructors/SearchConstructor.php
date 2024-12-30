<?php
namespace App\Services\Constructors;
use Illuminate\Http\Request;

interface SearchConstructor
{
    /**
     * Search cars by title
     *
     * @param Request $request
     * @return array
     */
    public function searchByTitle(Request $request) : array;
}
