<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name'
    ];

    public function records()
    {
        return $this->hasMany('App\Record');
    }
}
