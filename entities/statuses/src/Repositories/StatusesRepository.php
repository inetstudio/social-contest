<?php

namespace InetStudio\SocialContest\Statuses\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Repositories\StatusesRepositoryContract;

/**
 * Class StatusesRepository.
 */
class StatusesRepository extends BaseRepository implements StatusesRepositoryContract
{
    /**
     * StatusesRepository constructor.
     *
     * @param StatusModelContract $model
     */
    public function __construct(StatusModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'name', 'alias', 'color_class', 'description'];
        $this->relations = [];
    }
}
