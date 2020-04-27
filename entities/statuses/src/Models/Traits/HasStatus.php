<?php

namespace InetStudio\SocialContest\Statuses\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Trait HasStatus.
 */
trait HasStatus
{
    /**
     * Отношение "один к одному" с моделью статуса.
     *
     * @return HasOne
     *
     * @throws BindingResolutionException
     */
    public function status(): HasOne
    {
        $statusModel = app()->make('InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract');

        return $this->hasOne(
            get_class($statusModel),
            'id',
            'status_id'
        );
    }
}
