<?php

namespace App\Filament\Managmentsubscription\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class ManagmentSubscriptionTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'إحصائيات المستخدمين';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
            )
            ->columns([
                TextColumn::make('name')->label('اسم المستخدم'),
                TextColumn::make('email')->label('البريد الألكتروني'),
                TextColumn::make('plan')->label('نوع الاشتراك'),
                TextColumn::make('account_type')->label('نوع الحساب'),
            ]);
    }
}
