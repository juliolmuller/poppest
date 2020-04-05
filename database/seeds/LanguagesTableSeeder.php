<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Seed the 'languages' table with the records chosen bu me.
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
