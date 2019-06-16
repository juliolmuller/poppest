<?php

use Illuminate\Database\Seeder;
use App\Repository;
use App\Language;

class RepositoriesTableSeeder extends Seeder
{
    /**
     * Seed the 'repositories' table with GitHub API data.
     */
    public function run()
    {
        Repository::reset(Language::all());
    }
}
