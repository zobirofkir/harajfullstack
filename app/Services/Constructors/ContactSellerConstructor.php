<?php
namespace App\Services\Constructors;

use App\Http\Requests\ContactSellerRequest;

interface ContactSellerConstructor
{
    /**
     * Contact seller
     *
     * @param ContactSellerRequest $request
     * @return array
     */
    public function store(ContactSellerRequest $request) : array;
}
