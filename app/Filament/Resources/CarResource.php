<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'السيارات';
    protected static ?string $navigationLabel = 'السيارات';
    protected static ?string $pluralLabel = 'السيارات';
    protected static ?string $navigation = 'السيارات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('التصنيف')
                    ->relationship('category', 'title')
                    ->options(function () {
                        $user = Auth::user();
                        return Category::where('user_id', $user->id)->pluck('title', 'id');
                    })
                    ->required(),

                Select::make('logo_id')
                    ->label('الشعار')
                    ->relationship('logo', 'title')
                    ->required(),

                Select::make('gasoline_id')
                    ->label('نوع الوقود')
                    ->relationship('gasoline', 'type')
                    ->required(),

                TextInput::make('title')
                    ->label('عنوان السيارة')
                    ->required()
                    ->maxLength(255), // Match database column length

                TextInput::make('phone')
                    ->label('الهاتف')
                    ->required()
                    ->maxLength(15), // Limit for phone numbers

                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('info')
                    ->label('معلومات إضافية')
                    ->required()
                    ->maxLength(200), // Match database column length

                TextInput::make('price')
                    ->label('السعر')
                    ->required()
                    ->numeric()
                    ->maxLength(10), // Adjust based on your schema

                TextInput::make('old_price')
                    ->label('السعر القديم')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                TextInput::make('address')
                    ->label('العنوان')
                    ->maxLength(255), // Match database column length

                Textarea::make('description')
                    ->label('الوصف')
                    ->maxLength(500), // Adjust as per your schema

                FileUpload::make('images')
                    ->label('صور السيارة')
                    ->multiple()
                    ->image()
                    ->required(),

                Hidden::make('user_id')->default(Auth::user()->id),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                ->label('صور السيارة')
                ->getStateUsing(fn($record) => $record->images[0] ?? null),

                TextColumn::make('category.title')
                    ->label('التصنيف'),

                TextColumn::make('title')
                    ->label('عنوان السيارة')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('السعر'),

                TextColumn::make('address')
                    ->label('العنوان'),

                TextColumn::make('created_at')
                    ->label('تم الإنشاء في')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('التصنيف')
                    ->relationship('category', 'title')
                    ->default(null),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
