<?php

/**
 * Define catch-all route to access the application
 */
Route::any('/{any?}', 'AppController@index')->where('any', '^(?!api/).*$');
