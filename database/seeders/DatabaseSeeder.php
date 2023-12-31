<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \AppPortofile\Models\User::factory(10)->create();
        $this->call(SettingSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SectionSeeder::class);
    }
}
