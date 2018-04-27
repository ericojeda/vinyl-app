<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'artist_id',
        'folder_id',
        'year',
        'thumb',
        'cover',
        'fields'
    ];

    protected $casts = [
        'fields' => 'array'
    ];
}
