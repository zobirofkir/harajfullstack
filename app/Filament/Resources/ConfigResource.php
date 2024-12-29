<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigResource\Pages;
use App\Filament\Resources\ConfigResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ConfigResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'الإعدادات';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'الحساب';

    protected static int $navigationPriority = 99;

    public static function form(Form $form): Form
    {
        $user = Auth::user();

        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('الصورة')
                    ->image()
                    ->required()
                    ->maxSize(1024)
                    ->rules(['image', 'max:1024', 'mimes:jpg,jpeg,png', 'required']),
                Forms\Components\TextInput::make('name')
                    ->label('الاسم')
                    ->default($user->name)
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->default($user->email)
                    ->required(),

                Forms\Components\TextInput::make('location')
                    ->label('الموقع')
                    ->default($user->location)
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(User::query()->where('id', Auth::user()->id))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الاسم')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->label('الموقع')->searchable()->sortable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConfigs::route('/'),
            'edit' => Pages\EditConfig::route('/{record}/edit'),
        ];
    }
}
