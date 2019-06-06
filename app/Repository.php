<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    /**
     * Explicitly declare associated table name (not required).
     */
    protected $table = 'repositories';

    /**
     * Stablish relationship to the table 'languages'.
     */
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
