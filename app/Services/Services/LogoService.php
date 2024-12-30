<?php
namespace App\Services\Services;

use App\Models\Logo;
use App\Services\Constructors\LogoConstructor;

class LogoService implements LogoConstructor
{
    public function index(): array
    {
        $logos = Logo::orderBy('created_at', 'desc')->get();
        return [
            'logos' => $logos
        ];
    }

    public function show(int $id) : array
    {
        $logo = Logo::findOrFail($id);
        $cars = $logo->cars;
        return [
            'logo' => $logo,
            'cars' => $cars
        ];
    }
}
