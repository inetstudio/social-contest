<?php

namespace InetStudio\SocialContest\Posts\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\SocialContest\Posts\Contracts\Services\Front\PostsServiceContract;

/**
 * Class PostsService.
 */
class PostsService extends BaseService implements PostsServiceContract
{
    /**
     * PostsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract'));
    }
}
