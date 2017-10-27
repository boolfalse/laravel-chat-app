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
        'token_key',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
