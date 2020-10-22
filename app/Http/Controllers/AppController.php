<?php

namespace App\Http\Controllers;

use App\Services\Tokenizer;
use App\Models\Repository;
use App\Models\Language;

class AppController extends Controller
{
    /**
     * Display 'Home' view
     */
    public function index()
    {
        $api = new Tokenizer();
        return view('home', [
            'timestamp' => $api->getTimestamp(),
            'token' => $api->getToken(),
        ]);
    }

    /**
     * Capture fresh data from the GitHub API
     */
    public function load(int $languageId = 0)
    {
        // If no ID was provided, reset all
        if (!$languageId) {
            Repository::reset(Language::all());
            return response(['success' => 'All languages updated successfully'], 200);
        }

        // If there is an ID reset requested languages
        Repository::reset(Language::find($languageId));
        return response(['success' => 'Languages #' . $languageId . ' updated successfully'], 200);
    }

    /**
     * Return the list of languages available in the database
     */
    public function getLanguages()
    {
        return Language::all();
    }

    /**
     * Returns the view for Repositories List
     */
    public function getRepositories($languageId)
    {
        $repositories = Repository::where('language_id', $languageId)->with('language')->orderBy('stars', 'DESC')->get();
        if (!count($repositories))
            return response(['error' => "No records found for language #{$languageId}"], 409);
        return $repositories;
    }
}
