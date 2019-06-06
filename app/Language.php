<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    /**
     * Apply resource to the model.
     */
    use SoftDeletes;

    /**
     * Explicitly declare associated table name.
     */
    protected $table = 'repositories';

    /**
     * Define 5 default programming languages as model.
     */
    public const CHOSEN = [
        'php',
        'javascript',
        'java',
        'python',
        'c#'
    ];
}
