<?php

namespace InetStudio\SocialContest\Prizes\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\SocialContest\Prizes\Contracts\Services\Front\PrizesServiceContract;

/**
 * Class PrizesService.
 */
class PrizesService extends BaseService implements PrizesServiceContract
{
    /**
     * PrizesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Prizes\Contracts\Repositories\PrizesRepositoryContract'));
    }
}
