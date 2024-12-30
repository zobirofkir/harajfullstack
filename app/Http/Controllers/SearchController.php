<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Facades\SearchFacade;

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
        $searchResults = SearchFacade::searchByTitle($request);
        $cars = $searchResults['cars'];
        $message = $searchResults['message'];
        return view('pages.search.results', compact('cars', 'message'));
    }
}
