<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * Stablish parental relationship to the table 'repositories'.
     */
    public function repositories()
    {
        return $this->hasMany('App\Repository');
    }
}
