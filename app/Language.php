<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    /**
     * Explicitly declare associated table name (not required).
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

    /**
     * Stablish parental relationship to the table 'repositories'.
     */
    public function repositories()
    {
        return $this->hasMany('App\Repository');
    }
}
