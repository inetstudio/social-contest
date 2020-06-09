<?php

namespace InetStudio\SocialContest\Posts\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use InetStudio\AdminPanel\Models\Traits\HasJSONColumns;
use InetStudio\SocialContest\Prizes\Models\Traits\HasPrizes;
use InetStudio\SocialContest\Statuses\Models\Traits\HasStatus;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;

class PostModel extends Model implements PostModelContract
{
    use Auditable;
    use SoftDeletes;
    use HasJSONColumns;

    const MATERIAL_TYPE = 'social_contest_post';

    protected bool $auditTimestamps = true;

    protected $table = 'social_contest_posts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'search_data' => 'array',
        'additional_info' => 'array',
    ];

    public function getTypeAttribute(): string
    {
        return self::MATERIAL_TYPE;
    }

    public function social(): MorphTo
    {
        return $this->morphTo();
    }

    use HasUser;
    use HasPrizes;
    use HasStatus;
}
