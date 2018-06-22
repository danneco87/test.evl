<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Squad
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Players[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Teams[] $teams
 * @mixin \Eloquent
 */
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
