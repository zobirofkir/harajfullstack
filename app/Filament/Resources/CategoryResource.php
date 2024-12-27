<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'التصنيفات';

    protected static ?string $navigationLabel = 'التصنيفات';

    protected static ?string $pluralLabel = 'التصنيفات';

    protected static ?string $navigation = 'التصنيفات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('العنوان')
                    ->required()
                    ->maxLength(255),
                Hidden::make('user_id')->default(Auth::user()->id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(Category::query()->where('user_id', Auth::user()->id))
            ->columns([
                TextColumn::make('title')->label('العنوان')->sortable()->searchable(),
                TextColumn::make('user.name')->label('المستخدم')->sortable(),
            ])
            ->filters([
                // Add filters if needed
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
            // Add any relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
