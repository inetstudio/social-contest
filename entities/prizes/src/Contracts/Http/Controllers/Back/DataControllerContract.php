<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

interface DataControllerContract
{
    public function getIndexData(GetIndexDataRequestContract $request, GetIndexDataResponseContract $response): GetIndexDataResponseContract;
}
