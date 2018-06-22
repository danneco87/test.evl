<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Selection
 *
 * @property-read \App\Models\Squad $selection
 * @mixin \Eloquent
 */
class Selection extends Model
{
    public function selection(){
        return $this->hasOne('App\Models\Squad');
    }

}
