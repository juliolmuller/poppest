<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Seed the 'languages' table with the records chosen within the model.
     */
    public function run()
    {
        $languages = [];
        foreach (Language::CHOSEN as $lang)
            array_push($languages, ['name' => $lang]);
        DB::table('languages')->insert($languages);
    }
}
