<?php

namespace InetStudio\SocialContest\Posts\Models;

use Rutorika\Sortable\SortableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use InetStudio\AdminPanel\Models\Traits\HasJSONColumns;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;

/**
 * Class PostModel.
 */
class PostModel extends Model implements PostModelContract
{
    use SoftDeletes;
    use SortableTrait;
    use HasJSONColumns;
    use RevisionableTrait;

    const MATERIAL_TYPE = 'social_contest_post';

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
        'hash', 'social_type', 'social_id', 'status_id', 'position', 'search_data',
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
    ];

    /**
     * Сеттер атрибута hash.
     *
     * @param $value
     */
    public function setHashAttribute($value)
    {
        $this->attributes['hash'] = strip_tags($value);
    }

    /**
     * Сеттер атрибута status_id.
     *
     * @param $value
     */
    public function setStatusIdAttribute($value)
    {
        $this->attributes['status_id'] = (int) strip_tags($value);
    }

    /**
     * Сеттер атрибута search_data.
     *
     * @param $value
     */
    public function setSearchDataAttribute($value)
    {
        $this->attributes['search_data'] = json_encode((array) $value);
    }

    /**
     * Тип материала.
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        return self::MATERIAL_TYPE;
    }

    /**
     * Полиморфное отношение с моделями социальных постов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function social()
    {
        return $this->morphTo();
    }

    /**
     * Отношение "один к одному" с моделью статуса.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(
            app()->make('InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract'),
            'id', 
            'status_id'
        );
    }

    /**
     * Отношение "один к одному" с моделью приза.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function prizes()
    {
        return $this->belongsToMany(
            app()->make('InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract'),
            'social_contest_posts_prizes', 
            'post_id', 
            'prize_id'
        )->withPivot(['stage_id', 'date'])->withTimestamps();
    }

    /**
     * Отношение "многие ко многим" с моделью тега.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(
            app()->make('InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract'),
            'social_contest_posts_tags',
            'post_id',
            'tag_id'
        )->withPivot('point_id')->withTimestamps();
    }

    /**
     * Отношение "многие ко многим" с моделью баллов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function points()
    {
        return $this->belongsToMany(
            app()->make('InetStudio\SocialContest\Points\Contracts\Models\PointModelContract'),
            'social_contest_posts_points',
            'post_id',
            'point_id'
        )->withPivot('tag_id')->withTimestamps();
    }    

    protected $revisionCreationsEnabled = true;
}
