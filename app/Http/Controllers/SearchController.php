<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Models\Car;

class SearchController extends Controller
{
    /**
     * Search cars by title and return the results to a view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function searchByTitle(Request $request)
    {
        $query = $request->input('query');

        $cars = Car::where('title', 'LIKE', '%' . $query . '%')->get();

        $message = $cars->isEmpty() ? 'لا توجد سيارات بهذا العنوان.' : null;

        return view('pages.search.results', compact('cars', 'message'));
    }
}
