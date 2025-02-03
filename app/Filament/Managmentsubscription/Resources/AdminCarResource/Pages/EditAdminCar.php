<?php

namespace App\Filament\Managmentsubscription\Resources\AdminCarResource\Pages;

use App\Filament\Managmentsubscription\Resources\AdminCarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminCar extends EditRecord
{
    protected static string $resource = AdminCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
