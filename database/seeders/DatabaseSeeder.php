<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SystemLanguageSeeder::class,
            RoleSeeder::class,
            RouteListSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
