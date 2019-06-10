<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Seed the 'languages' table with the records chosen within the model.
     */
    public function run()
    {
        DB::table('languages')->insert([
            ['name' => 'PHP'],
            ['name' => 'Java'],
            ['name' => 'JavaScript'],
            ['name' => 'Python'],
            ['name' => 'C#']
        ]);
    }
}
