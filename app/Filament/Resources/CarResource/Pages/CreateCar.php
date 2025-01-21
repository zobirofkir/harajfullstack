<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    public function mount(): void
    {
        parent::mount();

        $user = Auth::user();

        if ($user->cars()->count() >= $user->carLimit()) {
            abort(403, 'لقد تجاوزت الحد الأقصى المسموح به لإعلانات خطتك.');
        }

        if (!$user->canCreateCar()) {
            abort(403, 'يمكنك إضافة إعلان جديد بعد مرور 24 ساعة على آخر إعلان.');
        }
    }
}
