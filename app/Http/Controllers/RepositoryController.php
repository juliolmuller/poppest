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
        $languages = Language::all();
        return view('home', compact('languages'));
    }

    /**
     * List the content stored in the database
     */
    public function show(int $languageId = 0)
    {
        if (empty($languageId))
            return Language::with(['language'])->get();
        return Language::findOrFail($languageId)->get();
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
