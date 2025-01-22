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

        User::create([
            "name" => "دينالي",
            "email" => "deenali@admin.com",
            "password" => "deenali123@@@",
            "location" => 'السعودية'
        ]);
    }
}
