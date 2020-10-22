<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * Stablish parental relationship to the table 'repositories'.
     */
    public function repositories()
    {
        return $this->hasMany('App\Repository');
    }
}
