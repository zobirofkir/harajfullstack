<?php

namespace App\Filament\Resources\GasolineResource\Pages;

use App\Filament\Resources\GasolineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGasolines extends ListRecords
{
    protected static string $resource = GasolineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
