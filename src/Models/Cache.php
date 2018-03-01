<?php

namespace Ksoft\Klaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
    protected $primaryKey = 'key';
    protected $table = 'cache';
    protected $casts = [
        'key'    => 'string',
        'value'    => 'array',
    ];

}
