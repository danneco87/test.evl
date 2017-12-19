<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    public function teams()
    {
        return $this->hasMany('App\Models\Teams');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Players');
    }
}
