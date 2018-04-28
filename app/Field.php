<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name'
    ];

    public function records()
    {
        return $this->belongsToMany('App\Record')->withPivot('value')->withTimestamps();
    }
}
