<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Category;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('السيارات', Car::count())
                ->description('عدد السيارات في النظام')
                ->chart([10, 20, 15, 60, 40, 100])
                ->color('success')
                ->icon('heroicon-o-truck'),
            Stat::make('المستخدمين', User::count())
                ->description('عدد المستخدمين المسجلين')
                ->chart([10, 20, 50, 30, 110, 100])
                ->color('success')
                ->icon('heroicon-o-users'),
            Stat::make('التصنيفات', Category::count())
                ->description('عدد التصنيفات الموجودة')
                ->chart([2, 4, 6, 50, 10, 102])
                ->color('success')
                ->icon('heroicon-o-folder'),
        ];
    }
}
