<?php

namespace InetStudio\SocialContest\Statuses\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasStatus
{
    public function status(): HasOne
    {
        $statusModel = resolve('InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract');

        return $this->hasOne(
            get_class($statusModel),
            'id',
            'status_id'
        );
    }
}
