<?php

namespace App\Http\Controllers;

use DB;
use App\Repository;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class RepositoryController extends Controller
{
    /**
     * Fix constant for GitHub API URL.
     */
    private const GITHUB_API = 'https://api.github.com/search/repositories';

    /**
     * Return an array with the required parameters for the request.
     */
    private static function getParams(string $language)
    {
        return [
            'q' => 'language:' . $language,
            'sort' => 'stars',
            'order' => 'desc'
        ];
    }

    /**
     * Delete (softly) all records in 'repositories' table.
     */
    private static function reset(string $language = '')
    {
        Repository::where('language', 'like', "%{$$language}%")->delete();
    }

    /**
     * Capture data from external API and save into database.
     */
    public function load(string $language = null)
    {
        $response = Curl::to(self::GITHUB_API)
            ->withHeader('User-Agent: juliolmuller')
            ->withData(self::getParams($language))
            ->get();
        $this->reset();
        return '<h1>Records deleted!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $language = null)
    {
        //
    }
}
