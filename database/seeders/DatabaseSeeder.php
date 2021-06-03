<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() == 'production') {
            $this->call([
                RolesAndPermissionsSeeder::class,
                UserSeeder::class,
                SymptomSeeder::class,
                DiseaseSeeder::class,
                ArticleSeeder::class,
                RuleSeeder::class,
            ]);
        } else {
            $this->call([
                RolesAndPermissionsSeeder::class,
                UserSeeder::class,
                SymptomSeeder::class,
                DiseaseSeeder::class,
                ArticleSeeder::class,
                RuleSeeder::class,
            ]);
        }
    }
}
