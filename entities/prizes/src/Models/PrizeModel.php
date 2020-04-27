<?php

namespace InetStudio\SocialContest\Prizes\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;

/**
 * Class PrizeModel.
 */
class PrizeModel extends Model implements PrizeModelContract
{
    use Auditable;
    use SoftDeletes;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'social_contest_prize';

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
    protected $table = 'social_contest_prizes';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'alias',
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
     * Геттер атрибута type.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    /**
     * Связь с моделью поста.
     *
     * @return BelongsToMany
     *
     * @throws BindingResolutionException
     */
    public function posts(): BelongsToMany
    {
        $checkModel = app()->make('InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract');

        return $this->belongsToMany(
            get_class($checkModel),
            'social_contest_posts_prizes',
            'prize_id',
            'post_id'
        )
            ->withPivot(['confirmed', 'date_start', 'date_end'])
            ->withTimestamps();
    }
}
