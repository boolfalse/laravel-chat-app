<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'access',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
