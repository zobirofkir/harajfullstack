<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class PCategoryChartWidget extends ChartWidget
{
    protected static ?string $heading = 'إحصائيات التصنيفات';

    protected function getData(): array
    {
        $categoriesPerMonth = Category::query()
            ->where('user_id', Auth::id()) 
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $categoriesPerMonth[$i] ?? 0;
        }

        return [
            'labels' => [
                'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
                'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
            ],
            'datasets' => [
                [
                    'label' => 'التصنيفات الشهرية',
                    'data' => $data,
                    'borderColor' => 'rgba(34, 197, 94, 1)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'fill' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
