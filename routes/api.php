<?php

/**
 * Routes to capture data stored in database.
 */
Route::get('/show/{languageId?}', 'RepositoryController@show');

/**
 * Toute to update database content (connects with external API)
 */
Route::get('/load/{languageId?}', 'RepositoryController@load');
