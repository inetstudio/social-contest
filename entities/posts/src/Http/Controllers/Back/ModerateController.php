<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ModerateControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Moderation\ModerateRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Moderation\ModerateResponseContract;

class ModerateController extends Controller implements ModerateControllerContract
{
    public function moderate(ModerateRequestContract $request, ModerateResponseContract $response): ModerateResponseContract
    {
        return $response;
    }
}
