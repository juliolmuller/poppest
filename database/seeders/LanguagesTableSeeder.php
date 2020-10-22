<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Seed the 'languages' table with the records chosen bu me.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'Kotlin'],
            ['name' => 'Java'],
            ['name' => 'Python'],
        ]);
    }
}
