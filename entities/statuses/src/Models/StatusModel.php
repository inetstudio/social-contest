<?php

namespace InetStudio\SocialContest\Statuses\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InetStudio\Classifiers\Models\Traits\HasClassifiers;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

/**
 * Class StatusModel.
 */
class StatusModel extends Model implements StatusModelContract
{
    use Auditable;
    use SoftDeletes;
    use HasClassifiers;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'social_contest_status';

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
    protected $table = 'social_contest_statuses';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'alias',
        'description',
        'color_class',
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
     * Отношение "один ко многим" с моделью постов.
     *
     * @return HasMany
     *
     * @throws BindingResolutionException
     */
    public function posts(): HasMany
    {
        $postModel = app()->make('InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract');

        return $this->hasMany(
            get_class($postModel),
            'status_id',
            'id'
        );
    }
}
