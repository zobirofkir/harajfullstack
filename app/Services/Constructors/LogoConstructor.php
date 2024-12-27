<?php
namespace App\Services\Constructors;

interface LogoConstructor
{
    public function index() : array;

    public function show(int $id) : array;
}
