<?php

namespace App\Http\Controllers;

use App\Services\Facades\SearchFacade;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search cars by title and return the results to a view.
     *
     * @return \Illuminate\View\View
     */
    public function searchByTitle(Request $request)
    {
        $searchResults = SearchFacade::searchByTitle($request);
        $cars = $searchResults['cars'];
        $message = $searchResults['message'];

        return view('pages.search.results', compact('cars', 'message'));
    }
}
