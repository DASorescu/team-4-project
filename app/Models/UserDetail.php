<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['first_name','lasst_name','phone','address'];

    public function user(){

        return $this->belongsTo('App\User');
    }
}
