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
}
