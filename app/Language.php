<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use SoftDeletes;

    /**
     * Limit searchable programing languages to these 5:
     */
    public const LANGUAGES = [
        'php',
        'javascript',
        'java',
        'python',
        'c#'
    ];
}
