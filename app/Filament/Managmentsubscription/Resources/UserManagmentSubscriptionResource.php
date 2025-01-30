<?php

namespace App\Filament\Managmentsubscription\Resources;

use App\Filament\Managmentsubscription\Resources\UserManagmentSubscriptionResource\Pages;
use App\Filament\Managmentsubscription\Resources\UserManagmentSubscriptionResource\RelationManagers;
use App\Models\User;
use App\Models\UserManagmentSubscription;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserManagmentSubscriptionResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'المستخدمين';
    protected static ?string $navigationLabel = 'المستخدمين';
    protected static ?string $pluralLabel = 'المستخدمين';
    protected static ?string $navigation = 'المستخدمين';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                Select::make('plan')
                    ->label('الخطة')
                    ->options([
                        'خطة مجانية' => 'مجانية',
                        'semi_annual' => 'نصف سنوية',
                        'annual' => 'سنوية',
                    ])
                    ->default($user->plan ?? 'خطة مجانية')
                    ->searchable()
                    ->preload()
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('plan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserManagmentSubscriptions::route('/'),
            // 'create' => Pages\CreateUserManagmentSubscription::route('/create'),
            'edit' => Pages\EditUserManagmentSubscription::route('/{record}/edit'),
        ];
    }
}
