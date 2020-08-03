<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    protected $fillable = [
        'name', 'created_by','assigned_to', 'status', 'description',
    ];

    public function manager(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function developer(){
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }
}
