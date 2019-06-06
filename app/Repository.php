<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    /**
     * Apply resource to the model.
     */
    use SoftDeletes;

    /**
     * Explicitly declare associated table name.
     */
    protected $table = 'repositories';
}
