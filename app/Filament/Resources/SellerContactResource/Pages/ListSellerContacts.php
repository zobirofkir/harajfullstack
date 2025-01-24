<?php

namespace App\Filament\Resources\SellerContactResource\Pages;

use App\Filament\Resources\SellerContactResource;
use App\Models\SellerContact;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ListSellerContacts extends ListRecords
{
    protected static string $resource = SellerContactResource::class;

    protected function getTableQuery(): Builder
    {
        $user = Auth::user();

        if ($user) {
            $carIds = $user->cars()->pluck('id')->toArray();

            return SellerContact::query()->whereIn('car_id', $carIds);
        }

        return SellerContact::query()->whereRaw('0 = 1');
    }
}
