<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Category;
use App\Models\Logo;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class OverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $stats = [
            Stat::make('الصفحة ', 'الرئيسية')
                ->description('الصفحة الرئيسية')
                ->description('الصفحة الرئيسية')
                ->color('info')
                ->icon('heroicon-o-home')
                ->url(route('home')),

            Stat::make('السيارات', $user->cars()->count())
                ->description('عدد السيارات المرتبطة بك')
                ->color('success')
                ->icon('heroicon-o-truck')
        ];

        if ($user->hasPlan('خطة مجانية')) {
            $stats[] = Stat::make('الخطة', 'مجانية')
                ->description('إعلانين يوميًا كحد أقصى')
                ->color('info')
                ->icon('heroicon-o-gift')
                ->url(route('moyasar.activate', ['user' => $user->id]));
        } elseif ($user->hasPlan('semi_annual')) {
            $stats[] = Stat::make('الخطة', ' نصف سنوية')
                ->description('عدد لا محدود من الإعلانات')
                ->color('warning')
                ->icon('heroicon-o-star')
                ->url(route('moyasar.activate', ['user' => $user->id]));
        } elseif ($user->hasPlan('annual')) {
            $stats[] = Stat::make('الخطة', ' سنوية')
                ->description('عدد لا محدود من الإعلانات مع سعر ثابت')
                ->color('success')
                ->icon('heroicon-o-star')
                ->url(route('moyasar.activate', ['user' => $user->id]));
        }

        return $stats;
    }
}
