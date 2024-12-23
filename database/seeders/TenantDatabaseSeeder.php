<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'Zonal Head']);
        Role::create(['name' => 'Reginal Manager']);
        Role::create(['name' => 'Branch Manager']);
        Role::create(['name' => 'Teritory Incharge']);
    }
}
