<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ixudra\Curl\Facades\Curl;

class Repository extends Model
{
    use HasFactory;

    /**
     * Fix constant for GitHub API URL.
     */
    private const GITHUB_API = 'https://api.github.com/search/repositories';

    /**
     * Submit request to API and return the response.
     */
    private static function getFromAPI(string $language)
    {
        // Use 'ixudra/curl' to consume API
        return Curl::to(self::GITHUB_API)
            ->withHeader('User-Agent: juliolmuller')
            ->withContentType('application/json')
            ->withData([
                'q' => 'language:' . mb_strtolower($language),
                'sort' => 'stars',
                'order' => 'desc'
            ])->get();
    }

    /**
     * Delete (softly) all records in 'repositories' table.
     */
    public static function reset($languages)
    {
        // Convert single parameter to array
        if (!is_iterable($languages)) $languages = [$languages];

        // Create array to receive all objects to be added to the database
        $repositories = [];

        // Iterate on every language passed as parameter
        foreach ($languages as $language) {

            // Erase previous data from
            self::where('language_id', $language->id)->delete();

            // Submit request to external API
            $response = json_decode(self::getFromAPI($language->name));
            foreach ($response->items as $item) {
                array_push($repositories, [
                    'full_name' => $item->full_name,
                    'name' => $item->name,
                    'owner' => $item->owner->login,
                    'avatar' => $item->owner->avatar_url,
                    'url' => $item->html_url,
                    'stars' => $item->stargazers_count,
                    'forks' => $item->forks_count,
                    'language_id' => $language->id,
                    'description' => $item->description
                ]);
            }
        }

        // Insert data into database
        self::insert($repositories);
    }

    /**
     * Stablish relationship to the table 'languages'.
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
