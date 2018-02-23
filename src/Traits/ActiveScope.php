<?php

namespace Ksoft\Klaravel\Traits;

/**
* Trait ActiveScope.
*/
trait ActiveScope
{
    /**
     * Scope a query to only include boolean of a given type.
     * defaults to 'active' attr name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $type = 'active')
    {
        return $query->where($type, 1);
    }
}
