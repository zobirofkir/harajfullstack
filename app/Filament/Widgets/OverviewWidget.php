<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Category;
use App\Models\Logo;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

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
        $activationUrl = route('moyasar.activate', ['user' => $user->id]);

        // Check if the user has the 'admin' role
        if ($user->hasRole('admin')) {
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

                Stat::make('حالة الحساب', 'تم تأكيد حسابك')
                    ->description('حسابك مفعل')
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
            ];
        }

        $stats = [
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
        ];

        if ($user->is_active) {
            $stats[] = Stat::make('حالة الحساب', 'تم تأكيد حسابك')
                ->description('حسابك مفعل')
                ->color('success')
                ->icon('heroicon-o-check-circle');
        } else {
            $stats[] = Stat::make('حالة الحساب', 'تفعيل الحساب مطلوب')
                ->description('اضغط لتفعيل الحساب')
                ->color('danger')
                ->url($activationUrl)
                ->icon('heroicon-o-exclamation-circle');
        }

        return $stats;
    }
}
