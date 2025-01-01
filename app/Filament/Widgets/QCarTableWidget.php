<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class QCarTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'إحصائيات السيارات';

    public function table(Table $table): Table
    {
        return $table
            ->query(Car::query())
            ->columns([
                ImageColumn::make('image')
                    ->label('صورة السيارة')
                    ->getStateUsing(fn ($record) => $record->images[0] ?? null),
                Tables\Columns\TextColumn::make('title')
                    ->label('اسم السيارة')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الأضافة')
                    ->searchable()
                    ->sortable(),
            ]);
    }
}
