<?php

namespace InetStudio\SocialContest\Stages\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\SocialContest\Stages\Contracts\Models\StageModelContract;
use InetStudio\SocialContest\Stages\Contracts\Repositories\StagesRepositoryContract;

/**
 * Class StagesRepository.
 */
class StagesRepository extends BaseRepository implements StagesRepositoryContract
{
    /**
     * StagesRepository constructor.
     *
     * @param StageModelContract $model
     */
    public function __construct(StageModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'name', 'alias', 'description'];
        $this->relations = [];
    }
}
