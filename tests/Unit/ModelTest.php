<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Language;
use App\Models\Repository;

class ModelTest extends TestCase
{
    /**
     * Constants for the tests.
     */
    private const COUNT_FACTOR_1 = 5;  // Number of 'languages' (defined within seeder)
    private const COUNT_FACTOR_2 = 30; // Number of repositories per language received from GitHub

    /**
     * Count the number of records in 'languages' table.
     *
     * @test
     */
    public function tables_records_count_test()
    {
        // Check quantity of records in 'languages' table
        $count = Language::count();
        $this->assertEquals(self::COUNT_FACTOR_1, $count);

        // Check quantity of records in 'repositories' table
        $count = Repository::count();
        $this->assertEquals(self::COUNT_FACTOR_1 * self::COUNT_FACTOR_2, $count);
    }

    /**
     * Count 'repositories' records by language.
     *
     * @test
     */
    public function repositories_per_language_count_test()
    {
        $languages = Language::all();
        foreach ($languages as $language) {
            $count = Repository::where('language_id', $language->id)->count();
            $this->assertEquals(self::COUNT_FACTOR_2, $count);
        }
    }
}
