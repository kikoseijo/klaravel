<?php

namespace Ksoft\Klaravel\Traits;

use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Relations\MorphMany;
/**
* Trait HasLogs.
*/
trait HasLogs
{
    use LogsActivity;
    protected static $recordEvents = ['deleted', 'created'];
    public function logs(): MorphMany
    {
        return $this->morphMany(
            ActivitylogServiceProvider::determineActivityModel(),
            'subject'
        )->orderBy('id', 'DESC');
    }
}
