<?php

namespace InetStudio\SocialContest\Tags\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\SocialContest\Tags\Contracts\Services\Front\TagsServiceContract;

/**
 * Class TagsService.
 */
class TagsService extends BaseService implements TagsServiceContract
{
    /**
     * TagsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Tags\Contracts\Repositories\TagsRepositoryContract'));
    }
}
