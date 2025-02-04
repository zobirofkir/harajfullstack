<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use Filament\Tables;
use Filament\Tables\Actions\ButtonAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class QCarTableWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'إحصائيات السيارات';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Car::query()
                    ->where('user_id', Auth::id())
            )
            ->defaultSort('created_at', 'desc')
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
                    ->label('تاريخ الإضافة')
                    ->searchable()
                    ->getStateUsing(fn ($record) => $record->created_at->diffForHumans())
                    ->sortable(),
            ])
            ->headerActions([
                ButtonAction::make('create')
                    ->label('إضافة سيارة جديدة')
                    ->url('admin/cars/create')
                    ->icon('heroicon-o-plus-circle'),
            ]);
    }
}
