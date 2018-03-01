<?php

namespace Ksoft\Klaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $casts = [
        'id'    => 'string',
    ];

    public function visitor()
    {
        return $this->belongsTo(config('auth.providers.users.model', 'App\User'), 'user_id');

    }
}
