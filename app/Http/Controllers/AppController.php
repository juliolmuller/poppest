<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Tokenizer;
use App\Repository;
use App\Language;

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
            return response(['success' => 'All languages updated successfully,'], 200);
        }

        // If there is an ID reset requested languages
        Repository::reset(Language::find($languageId));
        return response(['success' => 'Languages #' . $languageId . ' updated successfully,'], 200);
    }

    /**
     * Returns the view for Repositories List
     */
    public function show($languageId)
    {
        $repositories = Repository::where('language_id', $languageId)->orderBy('stars', 'DESC')->get();
        if (!count($repositories))
            return response(['errors' => "No records found for language '{$languageId}'"], 422);
        return view('components.repositories', [
            'id' => $languageId,
            'repositories' => $repositories
        ]);
    }

    /**
     * Display details for the repository
     */
    function display($repositoryId)
    {
        $repository = Repository::with(['language'])->find($repositoryId);
        if (is_null($repository))
            return response(['errors' => "Unable to capture data for repository #{$repositoryId}"], 422);
        return $repository;
    }
}
