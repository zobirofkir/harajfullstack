<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\enums\RolesEnum;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RolesEnum::cases() as $roleEnum) {
            Permission::firstOrCreate(
                ['name' => $roleEnum->value, 'guard_name' => 'web']
            );
        }
    }
}
