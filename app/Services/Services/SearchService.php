<?php

namespace App\Services\Services;

use App\Models\Car;
use App\Services\Constructors\SearchConstructor;
use Illuminate\Http\Request;

class SearchService implements SearchConstructor
{
    /**
     * Search cars by title
     */
    public function searchByTitle(Request $request): array
    {
        $query = $request->input('query');

        $cars = Car::where('title', 'LIKE', '%'.$query.'%')->get();

        $message = $cars->isEmpty() ? 'لا توجد سيارات بهذا العنوان.' : null;

        return [
            'cars' => $cars,
            'message' => $message,
        ];
    }
}
