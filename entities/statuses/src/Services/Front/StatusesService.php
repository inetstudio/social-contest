<?php

namespace InetStudio\SocialContest\Statuses\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\SocialContest\Statuses\Contracts\Services\Front\StatusesServiceContract;

/**
 * Class StatusesService.
 */
class StatusesService extends BaseService implements StatusesServiceContract
{
    /**
     * StatusesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Statuses\Contracts\Repositories\StatusesRepositoryContract'));
    }
}
