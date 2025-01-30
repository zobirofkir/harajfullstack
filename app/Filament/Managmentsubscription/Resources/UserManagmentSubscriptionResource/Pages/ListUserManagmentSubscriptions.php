<?php

namespace App\Filament\Managmentsubscription\Resources\UserManagmentSubscriptionResource\Pages;

use App\Filament\Managmentsubscription\Resources\UserManagmentSubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserManagmentSubscriptions extends ListRecords
{
    protected static string $resource = UserManagmentSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
