<?php

namespace App\Filament\Resources\RegisterResource\Pages\Auth;

use App\Filament\Resources\RegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getImageFormComponent(),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getImageFormComponent(): Component
    {
        return FileUpload::make('image')
            ->label('الصورة')
            ->image()
            ->required()
            ->rules(['image', 'max:1024', 'mimes:jpg,jpeg,png']);
    }
}
