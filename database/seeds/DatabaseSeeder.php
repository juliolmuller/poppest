<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(LanguagesTableSeeder::class);
        $this->call(RepositoriesTableSeeder::class);
    }
}
