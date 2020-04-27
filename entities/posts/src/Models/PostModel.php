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

/**
 * Class PostModel.
 */
class PostModel extends Model implements PostModelContract
{
    use Auditable;
    use SoftDeletes;
    use HasJSONColumns;

    const MATERIAL_TYPE = 'social_contest_post';

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected bool $auditTimestamps = true;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'social_contest_posts';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'uuid', 'social_type', 'social_id',
        'status_id', 'search_data', 'additional_info',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы к базовым типам.
     *
     * @var array
     */
    protected $casts = [
        'search_data' => 'array',
        'additional_info' => 'array',
    ];

    /**
     * Тип материала.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return self::MATERIAL_TYPE;
    }

    /**
     * Полиморфное отношение с моделями социальных постов.
     *
     * @return MorphTo
     */
    public function social(): MorphTo
    {
        return $this->morphTo();
    }

    use HasUser;
    use HasPrizes;
    use HasStatus;
}
