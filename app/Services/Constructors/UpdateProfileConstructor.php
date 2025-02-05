<?php
namespace App\Services\Constructors;

use App\Http\Requests\UpdateProfileRequest;

interface UpdateProfileConstructor
{
    public function updateProfileForm();

    public function updateProfile(UpdateProfileRequest $request);
}
