<?php

namespace App\Filament\Resources\SellerContactResource\Pages;

use App\Filament\Resources\SellerContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSellerContact extends EditRecord
{
    protected static string $resource = SellerContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
