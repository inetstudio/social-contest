<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ModerateControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Moderation\ModerateRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Moderation\ModerateResponseContract;

/**
 * Class ModerateController.
 */
class ModerateController extends Controller implements ModerateControllerContract
{
    /**
     * Модерация поста.
     *
     * @param ModerateRequestContract $request
     * @param ModerateResponseContract $response
     *
     * @return ModerateResponseContract
     */
    public function moderate(ModerateRequestContract $request, ModerateResponseContract $response): ModerateResponseContract
    {
        return $response;
    }
}
