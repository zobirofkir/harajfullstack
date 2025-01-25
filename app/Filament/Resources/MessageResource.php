<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الرسائل';

    protected static ?string $navigationLabel = 'الرسائل';

    protected static ?string $pluralLabel = 'الرسائل';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->required()
                    ->email()
                    ->placeholder('example@example.com'),

                Textarea::make('content')
                    ->label('محتوى الرسالة')
                    ->required()
                    ->placeholder('اكتب رسالتك هنا...'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->label('البريد الإلكتروني'),
                TextColumn::make('content')->label('محتوى الرسالة'),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->getStateUsing(fn ($record) => $record->created_at->diffForHumans()),
            ])
            ->actions([
                Tables\Actions\Action::make('sendEmail')
                    ->label('إرسال رسالة')
                    ->form([
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->required()
                            ->email()
                            ->placeholder('example@example.com'),

                        Textarea::make('content')
                            ->label('محتوى الرسالة')
                            ->required()
                            ->placeholder('اكتب رسالتك هنا...'),
                    ])
                    ->action(function (array $data) {
                        Mail::raw($data['content'], function ($message) use ($data) {
                            $message->to($data['email'])
                                ->subject('رسالة جديدة');
                        });

                        // رسالة نجاح
                        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح.');
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
        ];
    }
}
