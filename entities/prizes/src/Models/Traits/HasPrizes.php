<?php

namespace InetStudio\SocialContest\Prizes\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Trait HasPrizes.
 */
trait HasPrizes
{
    /**
     * Связь с моделью приза.
     *
     * @return BelongsToMany
     *
     * @throws BindingResolutionException
     */
    public function prizes(): BelongsToMany
    {
        $prizeModel = app()->make('InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract');

        return $this->belongsToMany(
                get_class($prizeModel),
                'social_contest_posts_prizes',
                'post_id',
                'prize_id'
            )
            ->withPivot(['confirmed', 'date_start', 'date_end'])
            ->withTimestamps();
    }
}
