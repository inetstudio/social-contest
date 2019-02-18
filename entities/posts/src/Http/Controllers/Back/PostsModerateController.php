<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\ModerateResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsModerateControllerContract;

/**
 * Class PostsModerateController.
 */
class PostsModerateController extends Controller implements PostsModerateControllerContract
{
    /**
     * Модерация поста.
     *
     * @param int $id
     * @param string $statusAlias
     *
     * @return ModerateResponseContract
     */
    public function moderate(int $id, string $statusAlias): ModerateResponseContract
    {
        $postsModerateService = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsModerateServiceContract');

        $items = $postsModerateService->moderate($id, $statusAlias);

        return app()->makeWith('InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\ModerateResponseContract', [
            'result' => ($items->count() > 0),
            'items' => $items,
        ]);
    }
}
