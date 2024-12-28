<?php

namespace App\Filament\Resources\GasolineResource\Pages;

use App\Filament\Resources\GasolineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGasoline extends EditRecord
{
    protected static string $resource = GasolineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
