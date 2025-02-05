<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\Facades\UpdateProfileFacade;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    public function updateProfileForm()
    {
        return UpdateProfileFacade::updateProfileForm();
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        return UpdateProfileFacade::updateProfile($request);
    }
}
