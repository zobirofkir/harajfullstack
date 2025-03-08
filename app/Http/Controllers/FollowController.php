<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow(User $user)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'يجب تسجيل الدخول أولاً'
            ], 401);
        }

        $follower = auth()->user();

        if ($follower->id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكنك متابعة نفسك'
            ], 400);
        }

        if ($follower->isFollowing($user)) {
            $follower->following()->detach($user->id);
            $isFollowing = false;
            $message = 'تم إلغاء المتابعة';
        } else {
            $follower->following()->attach($user->id);
            $isFollowing = true;
            $message = 'تمت المتابعة بنجاح';
        }

        return response()->json([
            'success' => true,
            'isFollowing' => $isFollowing,
            'message' => $message
        ]);
    }
}
