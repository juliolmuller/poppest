<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

/**
 * Define catch-all route to access the application
 */
Route::any('/{any?}', [AppController::class, 'index'])->where('any', '^(?!api/).*$');
