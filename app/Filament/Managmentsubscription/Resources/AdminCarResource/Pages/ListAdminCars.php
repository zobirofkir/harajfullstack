<?php

namespace App\Filament\Managmentsubscription\Resources\AdminCarResource\Pages;

use App\Filament\Managmentsubscription\Resources\AdminCarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdminCars extends ListRecords
{
    protected static string $resource = AdminCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('اضافة سيارة'),
        ];
    }
}
