<?php

namespace InetStudio\SocialContest\Points\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\SocialContest\Points\Contracts\Services\Front\PointsServiceContract;

/**
 * Class PointsService.
 */
class PointsService extends BaseService implements PointsServiceContract
{
    /**
     * PointsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Points\Contracts\Repositories\PointsRepositoryContract'));
    }
}
