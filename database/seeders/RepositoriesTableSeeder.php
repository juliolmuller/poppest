<?php

namespace Database\Seeders;

use App\Models\Repository;
use App\Models\Language;
use Illuminate\Database\Seeder;

class RepositoriesTableSeeder extends Seeder
{
    /**
     * Seed the 'repositories' table with GitHub API data.
     *
     * @return void
     */
    public function run()
    {
        Repository::reset(Language::all());
    }
}
