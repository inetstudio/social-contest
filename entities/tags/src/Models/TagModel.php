<?php

namespace InetStudio\SocialContest\Tags\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract;

/**
 * Class TagModel.
 */
class TagModel extends Model implements TagModelContract, Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    const MATERIAL_TYPE = 'social_contest_tag';

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'social_contest_tags';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
     * Тип материала.
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        return self::MATERIAL_TYPE;
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
            'social_contest_posts_tags', 
            'tag_id', 
            'post_id'
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
            'social_contest_tags_points', 
            'tag_id', 
            'point_id'
        )->withPivot('post_id')->withTimestamps();
    }

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;
}
