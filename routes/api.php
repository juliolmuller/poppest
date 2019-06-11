<?php

/**
 * Routes to capture data stored in database.
 */
Route::post('/show/{languageId?}', 'RepositoryController@show');

/**
 * Toute to update database content (connects with external API)
 */
Route::post('/load/{languageId?}', 'RepositoryController@load');
