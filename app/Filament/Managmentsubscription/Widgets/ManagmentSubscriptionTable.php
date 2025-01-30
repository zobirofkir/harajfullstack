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
    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
            )
            ->columns([
                ImageColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('plan'),
                TextColumn::make('account_type'),
            ]);
    }
}
