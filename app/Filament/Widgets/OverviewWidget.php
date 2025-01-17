<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Category;
use App\Models\Logo;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Actions\LinkAction;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\LinkAction as ActionsLinkAction;

class OverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $carsCount = Car::where('user_id', $user->id)->count();
        $categoriesCount = Category::where('user_id', $user->id)->count();
        $logosCount = Logo::where('user_id', $user->id)->count();

        $activationUrl = route('moyasar.create');

        return [
            Stat::make('السيارات', $carsCount)
                ->description('عدد السيارات المرتبطة بك')
                ->chart([10, 20, 15, 60, 40, 100])
                ->color('success')
                ->icon('heroicon-o-truck'),

            Stat::make('الشعارات', $logosCount)
                ->description('عدد الشعارات')
                ->chart([10, 20, 50, 30, 110, 100])
                ->color('success')
                ->icon('heroicon-o-users'),

            Stat::make('التصنيفات', $categoriesCount)
                ->description('عدد التصنيفات المرتبطة بك')
                ->chart([2, 4, 6, 50, 10, 102])
                ->color('success')
                ->icon('heroicon-o-folder'),

            ActionsLinkAction::make('تفعيل الحساب')
                ->url($activationUrl)
                ->color('primary')
                ->icon('heroicon-o-check-circle')
        ];
    }
}
