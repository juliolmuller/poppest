<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Repository;

class RepositoryController extends Controller
{
    /**
     * Display 'Home' view
     */
    public function index()
    {
        $languages = Language::with(['repositories'])->get();
        return view('home', compact('languages'));
    }

    /**
     * Returns the view for Repositories List
     */
    public function show($languageId, Request $request)
    {
        $repositories = Repository::where('language_id', $languageId)->get();
        if (!count($repositories))
            return response(['errors' => "No records found for language '{$languageId}'"], 422);
        return view('components.repositories', [
            'id' => $languageId,
            'repositories' => $repositories,
            'display' => $request->display ?? ''
        ]);
    }

    /**
     * Capture fresh data from the GitHub API
     */
    public function load(int $languageId = 0)
    {
        // If no ID was provided, reset all
        if (empty($languageId)) {
            Repository::reset(Language::all());
            return $this->show();
        }

        // If there is an ID reset requested languages
        Repository::reset(Language::find($languageId));
        return $this->show($languageId);
    }
}
