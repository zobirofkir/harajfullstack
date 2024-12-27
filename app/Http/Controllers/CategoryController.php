<?php

namespace App\Http\Controllers;

use App\Services\Facades\CategoryFacade;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $categories = CategoryFacade::index();
        return view('welcome', compact('categories'));
    }
}
