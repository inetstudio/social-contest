<?php

namespace InetStudio\SocialContest\Prizes\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Repositories\PrizesRepositoryContract;

/**
 * Class PrizesRepository.
 */
class PrizesRepository extends BaseRepository implements PrizesRepositoryContract
{
    /**
     * PrizesRepository constructor.
     *
     * @param PrizeModelContract $model
     */
    public function __construct(PrizeModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'name', 'alias', 'description'];
        $this->relations = [];
    }
}
