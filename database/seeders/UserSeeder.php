<?php

namespace Database\Seeders;

use App\enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => RolesEnum::ADMIN->value, 'guard_name' => 'web']);

        $user = User::create([
            "name" => "دينالي",
            "email" => "deenali@admin.com",
            "password" => "deenali123@@@",
            "location" => 'السعودية',
            "role" => RolesEnum::ADMIN->value,
        ]);

        $user->assignRole($role);
    }
}
