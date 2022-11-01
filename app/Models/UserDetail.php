<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['first_name','last_name','address','image'];

    public function user(){

        return $this->belongsTo('App\User');
    }
}
