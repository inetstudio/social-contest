<?php

namespace InetStudio\SocialContest\Prizes\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;

class PrizeModel extends Model implements PrizeModelContract
{
    use Auditable;
    use SoftDeletes;

    const ENTITY_TYPE = 'social_contest_prize';

    protected bool $auditTimestamps = true;

    protected $table = 'social_contest_prizes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    public function posts(): BelongsToMany
    {
        $postModel = resolve('InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract');

        return $this->belongsToMany(
                get_class($postModel),
                'social_contest_posts_prizes',
                'prize_id',
                'post_id'
            )
            ->withPivot(['confirmed', 'date_start', 'date_end'])
            ->withTimestamps();
    }
}
