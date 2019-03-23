<?php

namespace InetStudio\SocialContest\Points\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\SocialContest\Points\Contracts\Models\PointModelContract;

/**
 * Class PointModel.
 */
class PointModel extends Model implements PointModelContract, Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    const MATERIAL_TYPE = 'social_contest_point';

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'social_contest_points';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'numeric', 'show',
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
     * Сеттер атрибута name.
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    /**
     * Сеттер атрибута alias.
     *
     * @param $value
     */
    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = strip_tags($value);
    }

    /**
     * Сеттер атрибута numeric.
     *
     * @param $value
     */
    public function setNumericAttribute($value)
    {
        $this->attributes['numeric'] = (int) $value;
    }

    /**
     * Сеттер атрибута show.
     *
     * @param $value
     */
    public function setShowAttribute($value)
    {
        $this->attributes['show'] = (int) $value;
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
     * Отношение "многие ко многим" с моделью тега.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(
            app()->make('InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract'),
            'social_contest_tags_points', 
            'point_id', 
            'tag_id'
        )->withPivot('post_id')->withTimestamps();
    }

    /**
     * Отношение "многие ко многим" с моделью поста.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(
            app()->make('InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract'),
            'social_contest_posts_points', 
            'point_id', 
            'post_id'
        )->withPivot('tag_id')->withTimestamps();
    }

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;
}
