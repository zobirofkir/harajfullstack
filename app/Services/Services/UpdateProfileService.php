<?php
namespace App\Services\Services;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\Constructors\UpdateProfileConstructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileService implements UpdateProfileConstructor
{
    public function updateProfileForm()
    {
        return view('pages.auth.update-profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->has('password') && $request->password) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(storage_path('app/public/'.$user->image))) {
                unlink(storage_path('app/public/'.$user->image));
            }

            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return back()->with('success', 'تم تحديث المعلومات بنجاح!');
    }

}
