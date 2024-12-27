<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'المستخدمون';

    protected static ?string $pluralLabel = 'المستخدمون';

    protected static ?string $navigationGroup = 'المستخدمون';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->label('الدور')
                    ->options(Role::all()->pluck('name', 'name')->toArray())
                    ->required()
                    ->multiple(false)
                    ->afterStateUpdated(fn ($state, $set, $get) => $set('roles', $state)),
            ])->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(User::query()->where('id', '!=', Auth::user()->id))

            ->columns([
                TextColumn::make('name')->label('الاسم')->sortable()->searchable(),
                TextColumn::make('email')->label('البريد الإلكتروني')->sortable()->searchable(),
                TextColumn::make('role')->label('الدور')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')

            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('حذف'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
