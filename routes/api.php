<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

/**
 * Request full-update to the database (capture recent info from GitHub API)
 */
Route::post('/load/{languageId?}', [AppController::class, 'load']);

/**
 * Get list of languages stored in database
 */
Route::get('/languages', [AppController::class, 'getLanguages']);

/**
 * Capture all records for the parameter 'languageId'
 */
Route::get('/repositories/{languageId}', [AppController::class, 'getRepositories']);
