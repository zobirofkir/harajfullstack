<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellerContactResource\Pages;
use App\Filament\Resources\SellerContactResource\RelationManagers;
use App\Models\Car;
use App\Models\SellerContact;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SellerContactResource extends Resource
{
    protected static ?string $model = SellerContact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'الاتصال بالبائع';
    protected static ?string $navigationLabel = 'الاتصال بالبائع';
    protected static ?string $pluralLabel = 'الاتصال بالبائع';
    protected static ?string $navigation = 'الاتصال بالبائع';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('phone')->required(),
                TextInput::make('email')->required(),
                TextInput::make('message')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('phone'),
                TextColumn::make('email'),
                TextColumn::make('message'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()->label('عرض'),
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
            'index' => Pages\ListSellerContacts::route('/'),
        ];
    }
}
