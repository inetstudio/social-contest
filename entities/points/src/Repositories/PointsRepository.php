<?php

namespace InetStudio\SocialContest\Points\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\SocialContest\Points\Contracts\Models\PointModelContract;
use InetStudio\SocialContest\Points\Contracts\Repositories\PointsRepositoryContract;

/**
 * Class PointsRepository.
 */
class PointsRepository extends BaseRepository implements PointsRepositoryContract
{
    /**
     * PointsRepository constructor.
     *
     * @param PointModelContract $model
     */
    public function __construct(PointModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'name', 'alias', 'numeric', 'show'];
        $this->relations = [];
    }
}
