<?php

/**
 * Routes to capture the data stored in database.
 */
Route::get('/{?language}', 'RepositoryController@show');
