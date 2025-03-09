<?php
namespace App\Services\Services;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\Constructors\UpdateProfileConstructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if ($request->has('password') && $request->password) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle profile image upload
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        // Handle cover photo upload
        if ($request->hasFile('cover_photo')) {
            if ($user->cover_photo) {
                Storage::disk('public')->delete($user->cover_photo);
            }
            $coverPath = $request->file('cover_photo')->store('cover_photos', 'public');
            $user->cover_photo = $coverPath;
        }

        $user->save();

        return back()->with('success', 'تم تحديث المعلومات بنجاح!');
    }
}
