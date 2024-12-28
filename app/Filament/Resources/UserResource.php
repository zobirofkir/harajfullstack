<?php

namespace App\Filament\Resources;

use App\enums\RolesEnum;
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

    protected static ?string $navigationGroup = 'المستخدمون';

    protected static ?string $navigationLabel = 'المستخدمون';

    protected static ?string $pluralLabel = 'المستخدمون';

    protected static ?string $navigation = 'المستخدمون';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(255)
                    ->rules(['string', 'max:255']),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->rules(['email', 'max:255']),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->required()
                    ->rules(['string', 'min:8', 'max:255']),
                Select::make('role')
                    ->label('الدور')
                    ->options(
                        Role::pluck('name', 'id')->toArray()
                    )
                    ->required()
                    ->multiple(false)
                    ->afterStateUpdated(fn ($state, $set, $get) => $set('role', $state)),
            ])->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(User::query()->where('id', '!=', Auth::user()->id))

            ->columns([
                TextColumn::make('name')->label('الاسم')->sortable()->searchable(),
                TextColumn::make('email')->label('البريد الإلكتروني')->sortable()->searchable(),
                TextColumn::make('created_at')->label('تاريخ الانشاء')->dateTime('d-m-Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')

            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
                Tables\Actions\DeleteAction::make()->label('حذف'),
            ])
            ->bulkActions([
                //
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
