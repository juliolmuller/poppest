<?php

/**
 * Request full-update to the database (capture recent info from GitHub API)
 */
Route::post('/load/{languageId?}', 'RepositoryController@load');

/**
 * Capture all records for the parameter 'languageId'
 */
Route::post('/show/{languageId}', 'RepositoryController@show');

/**
 * Capture data for a single repository record
 */
Route::get('/repository/{repositoryId}', 'RepositoryController@display');
