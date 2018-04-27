<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name'
    ];
}
