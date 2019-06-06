<?php

/**
 * Route to the home page of the application.
 */
Route::get('/', function () {
    return view('index', [
        'languges' => Language::all()
    ]);
});

/**
 * Route to capture data from GitHub API.
 */
Route::post('/load/{?language}', 'RepositoryController@load');
