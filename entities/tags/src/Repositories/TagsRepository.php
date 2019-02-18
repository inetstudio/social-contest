<?php

namespace InetStudio\SocialContest\Tags\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract;
use InetStudio\SocialContest\Tags\Contracts\Repositories\TagsRepositoryContract;

/**
 * Class TagsRepository.
 */
class TagsRepository extends BaseRepository implements TagsRepositoryContract
{
    /**
     * TagsRepository constructor.
     *
     * @param TagModelContract $model
     */
    public function __construct(TagModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'name'];
        $this->relations = [];
    }
}
