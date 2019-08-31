<?php


/**
 * Request full-update to the database (capture recent info from GitHub API)
 */
Route::post('/load/{languageId?}', 'AppController@load');

/**
 * Get list of languages stored in database
 */
Route::get('/languages', 'AppController@getLanguages');

/**
 * Capture all records for the parameter 'languageId'
 */
Route::get('/repositories/{languageId}', 'AppController@getRepositories');
