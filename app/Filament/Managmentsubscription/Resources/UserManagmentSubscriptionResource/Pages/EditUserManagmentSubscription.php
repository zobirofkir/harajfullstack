<?php

namespace App\Filament\Managmentsubscription\Resources\UserManagmentSubscriptionResource\Pages;

use App\Filament\Managmentsubscription\Resources\UserManagmentSubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserManagmentSubscription extends EditRecord
{
    protected static string $resource = UserManagmentSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
