<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    public function selection(){
        return $this->hasOne('App\Models\Squad');
    }

}
