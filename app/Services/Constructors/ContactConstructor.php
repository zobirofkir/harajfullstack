<?php
namespace App\Services\Constructors;

use App\Http\Requests\ContactRequest;

interface ContactConstructor
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return array
     */
    public function store(ContactRequest $request) : array;
}
