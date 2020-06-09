<?php

namespace InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

interface DataControllerContract
{
    public function getIndexData(GetIndexDataRequestContract $request, GetIndexDataResponseContract $response): GetIndexDataResponseContract;
}
