<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        $request = Http::withHeaders(['User-Agent' => 'juliolmuller']);
        $response = $request->get(self::GITHUB_API, [
            'q' => 'language:' . Str::lower($language),
            'sort' => 'stars',
            'order' => 'desc',
        ]);

        return json_decode($response->body());
    }

    /**
     * Delete (softly) all records in 'repositories' table.
     */
    public static function reset($languages)
    {
        if (!is_iterable($languages)) {
            $languages = [$languages];
        }

        $repositories = [];

        foreach ($languages as $language) {
            self::where('language_id', $language->id)->delete();
            $response = self::getFromAPI($language->name);

            foreach ($response->items as $item) {
                $repositories[] = [
                    'full_name' => $item->full_name,
                    'name' => $item->name,
                    'owner' => $item->owner->login,
                    'avatar' => $item->owner->avatar_url,
                    'url' => $item->html_url,
                    'stars' => $item->stargazers_count,
                    'forks' => $item->forks_count,
                    'language_id' => $language->id,
                    'description' => $item->description
                ];
            }
        }

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
