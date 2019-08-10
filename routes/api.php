<?php


/**
 * Request full-update to the database (capture recent info from GitHub API)
 */
Route::post('/load/{languageId?}', 'AppController@load');

/**
 * Capture all records for the parameter 'languageId'
 */
Route::get('/show/{languageId}', 'AppController@show');
