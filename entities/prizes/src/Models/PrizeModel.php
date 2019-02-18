<?php

namespace InetStudio\SocialContest\Prizes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;

/**
 * Class PrizeModel.
 */
class PrizeModel extends Model implements PrizeModelContract
{
    use SoftDeletes;
    use RevisionableTrait;

    const MATERIAL_TYPE = 'social_contest_prize';

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
        'name', 'alias', 'description',
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
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(str_replace("&nbsp;", ' ', strip_tags((isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : ''))));
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
            'social_contest_posts_prizes', 
            'prize_id', 
            'post_id'
        )->withTimestamps();
    }

    protected $revisionCreationsEnabled = true;
}
