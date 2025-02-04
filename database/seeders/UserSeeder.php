<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'username' => 'deenali',
            'name' => 'دينالي',
            'email' => 'deenali@admin.com',
            'password' => 'deenali123@@@',
            'plan' => 'annual',
            'account_type' => 'مشتري',
        ]);
    }
}
