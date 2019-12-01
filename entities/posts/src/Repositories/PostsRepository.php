<?php

namespace InetStudio\SocialContest\Posts\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract;

/**
 * Class PostsRepository.
 */
class PostsRepository extends BaseRepository implements PostsRepositoryContract
{
    /**
     * PostsRepository constructor.
     *
     * @param PostModelContract $model
     */
    public function __construct(PostModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'user_id', 'hash', 'social_type', 'social_id', 'status_id'];
        $this->relations = [
            'status' => function ($query) {
                $query->select(['id', 'name', 'alias', 'color_class']);
            },
        ];
    }
}
