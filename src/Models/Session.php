<?php

namespace Ksoft\Klaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $dates = [
        'last_activity',
    ];

    protected $casts = [
        'id'    => 'string',
        'last_activity'    => 'datetime',
    ];

    public function visitor()
    {
        return $this->belongsTo(config('auth.providers.users.model', 'App\User'), 'user_id');

    }
}
