<?php

namespace App\Filament\Managmentsubscription\Resources;

use App\Filament\Managmentsubscription\Resources\AdminCarResource\Pages;
use App\Models\Car;
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
use Illuminate\Support\Facades\Auth;

class AdminCarResource extends Resource
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

                TextInput::make('title')->label('اسم السيارة')->required()->maxLength(255),

                Textarea::make('description')->label('الوصف')->required()->maxLength(500)->rows(10),

                FileUpload::make('images')->label('صور السيارة')->multiple()->image()->required(),

                Select::make('price_type')
                    ->label('نوع السعر')
                    ->options([
                        'negotiable' => 'قابل للتفاوض',
                        'fixed' => 'ثابت',
                    ])
                    ->required()
                    ->reactive(),

                TextInput::make('price')
                    ->label('السعر')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                TextInput::make('negotiable_price')
                    ->label('قابل للتفاوض')
                    ->numeric()
                    ->maxLength(255)
                    ->visible(fn ($get) => $get('price_type') === 'negotiable'),

                Hidden::make('user_id')->default(Auth::user()->id),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')->label('صور السيارة')->getStateUsing(fn ($record) => $record->images[0] ?? null),
                TextColumn::make('title')->label('اسم السيارة')->searchable(),
                TextColumn::make('price')->label('السعر'),
                TextColumn::make('created_at')->label('تم الإنشاء في')->sortable()->getStateUsing(fn ($record) => $record->created_at->diffForHumans()),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('حذف مختار'),
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
            'index' => Pages\ListAdminCars::route('/'),
            'create' => Pages\CreateAdminCar::route('/create'),
            'edit' => Pages\EditAdminCar::route('/{record}/edit'),
        ];
    }
}
