<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Tambahkan role admin & user jika belum ada
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);
    }
}
