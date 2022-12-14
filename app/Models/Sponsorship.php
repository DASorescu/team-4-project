<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{

    public function users()
    {

        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('ends_at');
    }
}
