<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GasolineResource\Pages;
use App\Models\Gasoline;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class GasolineResource extends Resource
{
    protected static ?string $model = Gasoline::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'أنواع الوقود';

    protected static ?string $navigationLabel = 'أنواع الوقود';

    protected static ?string $pluralLabel = 'أنواع الوقود';

    protected static ?string $navigation = 'أنواع الوقود';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('type')
                    ->label('نوع الوقود')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255', 'unique:gasolines,type']), // Ensures type is unique and valid
                Hidden::make('user_id')
                    ->default(Auth::user()->id)
                    ->rules(['required', 'exists:users,id']), // Validates user_id exists
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Gasoline::query()->where('user_id', Auth::user()->id))
            ->columns([
                TextColumn::make('type')->label('نوع الوقود')->sortable()->searchable(),
                TextColumn::make('user.name')->label('المستخدم')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // يمكن إضافة الفلاتر هنا إذا لزم الأمر
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
                Tables\Actions\DeleteAction::make()->label('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('حذف مختار'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // يمكن إضافة العلاقات هنا إذا لزم الأمر
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGasolines::route('/'),
            'create' => Pages\CreateGasoline::route('/create'),
            'edit' => Pages\EditGasoline::route('/{record}/edit'),
        ];
    }
}
