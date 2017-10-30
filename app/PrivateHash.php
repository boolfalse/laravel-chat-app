<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateHash extends Model
{
    protected $table = 'private_hashes';
    protected $fillable = [
        'room_id',
        'hash',
    ];

    public function room(){
        return $this->belongsTo('App\Room');
    }
}
