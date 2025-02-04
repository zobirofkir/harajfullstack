<?php

namespace App\Filament\Managmentsubscription\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ManagmentSubscriptionTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'إحصائيات المستخدمين';

    public function table(Table $table): Table
    {
        $userCount = User::count();

        return $table
            ->query(
                User::query()
            )
            ->columns([
                TextColumn::make('name')->label('اسم المستخدم'),
                TextColumn::make('email')->label('البريد الألكتروني'),
                TextColumn::make('plan')->label('نوع الاشتراك'),
                TextColumn::make('account_type')->label('نوع الحساب'),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\ViewAction::make()->label('عرض المستخدمين')->url('/managment/subscriptions/user-managment-subscriptions')->icon('heroicon-s-user')->color('success'),
                Tables\Actions\ViewAction::make()->label('الصفحة الرئيسية')->url('/admin')->icon('heroicon-s-home')->color('info'),
                Action::make('user_count')
                    ->label("إجمالي المستخدمين: $userCount")
                    ->icon('heroicon-s-chart-bar')
                    ->extraAttributes(['style' => 'background-color: #cfaa00;']),
            ]);
    }
}
