<?php

namespace App\Http\Controllers;

use App\Services\Facades\CarFacade;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = CarFacade::index();

        return view('pages.cars.index', compact('cars'));
    }

    public function show(string $slug)
    {
        $car = CarFacade::show($slug);

        return view('pages.cars.show', compact('car'));
    }

    public function userCars(int $id)
    {
        $data = CarFacade::getUserCars($id);

        return view('pages.cars.user_cars', $data);
    }
}
