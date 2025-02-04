<?php

namespace App\Services\Constructors;

use Illuminate\Http\Request;

interface SearchConstructor
{
    /**
     * Search cars by title
     */
    public function searchByTitle(Request $request): array;
}
