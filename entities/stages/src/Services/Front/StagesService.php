<?php

namespace InetStudio\SocialContest\Stages\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\SocialContest\Stages\Contracts\Services\Front\StagesServiceContract;

/**
 * Class StagesService.
 */
class StagesService extends BaseService implements StagesServiceContract
{
    /**
     * StagesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Stages\Contracts\Repositories\StagesRepositoryContract'));
    }
}
