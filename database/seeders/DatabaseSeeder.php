<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CentralUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;
    public function run(): void
    {
        // User::factory(10)->create();
        Admin::create([
            'name' => 'Super User',
            'email' => 'superuser@superuser.com',
            'password' => static::$password ??= Hash::make('password'),
        ]);
    }
}
