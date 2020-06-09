<?php

namespace InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Moderation\ModerateRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Moderation\ModerateResponseContract;

interface ModerateControllerContract
{
    public function moderate(ModerateRequestContract $request, ModerateResponseContract $response): ModerateResponseContract;
}
