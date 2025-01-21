<?php
namespace App\Filament\Resources\RegisterResource\Pages\Auth;

use App\enums\RolesEnum;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;

class Register extends BaseRegister
{
    protected function handleRegistration(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole(RolesEnum::USER->value);

        return $user;
    }

    public function create(array $data): RegistrationResponse
    {
        $user = $this->handleRegistration($data);

        return $this->afterRegister($user);
    }

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
