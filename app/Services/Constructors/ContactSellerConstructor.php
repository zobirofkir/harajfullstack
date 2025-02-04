<?php

namespace App\Services\Constructors;

use App\Http\Requests\ContactSellerRequest;

interface ContactSellerConstructor
{
    /**
     * Contact seller
     */
    public function store(ContactSellerRequest $request): array;
}
