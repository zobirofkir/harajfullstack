<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    protected function beforeCreate(): void
    {
        $user = Auth::user();

        switch ($user->plan) {
            case 'خطة مجانية':
                $maxDailyAds = 2;
                $maxWeeklyAds = 7;
                break;

            case 'semi_annual':
                $maxDailyAds = PHP_INT_MAX;
                $maxWeeklyAds = PHP_INT_MAX;
                break;

            case 'annual':
                $maxDailyAds = PHP_INT_MAX;
                $maxWeeklyAds = PHP_INT_MAX;
                break;

            default:
                $maxDailyAds = 0;
                $maxWeeklyAds = 0;
        }

        $dailyAdsCount = $user->cars()->whereDate('created_at', now()->toDateString())->count();

        $weeklyAdsCount = $user->cars()->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])->count();

        if ($dailyAdsCount >= $maxDailyAds) {
            abort(403, 'لقد وصلت إلى الحد الأقصى للإعلانات اليومية.');
        }

        if ($weeklyAdsCount >= $maxWeeklyAds) {
            abort(403, 'لقد وصلت إلى الحد الأقصى للإعلانات الأسبوعية.');
        }
    }
}
