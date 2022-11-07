<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user(){
        
        return $this->belongsTo('App\User');
    }
    protected $dateFormat = 'Y-m-d H:i:s.uO';

}
