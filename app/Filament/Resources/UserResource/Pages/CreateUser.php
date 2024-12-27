<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public static function canView(): bool
    {
        return Auth::user()->can('create', User::class);
    }

    protected function handleRecordCreation(array $data): User
    {
        $user = User::create($data);

        if (isset($data['role'])) {
            $role = Role::find($data['role']);
            if ($role) {
                $user->assignRole($role);
            }
        }

        return $user;
    }
}
