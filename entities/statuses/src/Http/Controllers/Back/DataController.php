<?php

namespace InetStudio\SocialContest\Statuses\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\DataControllerContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

class DataController extends Controller implements DataControllerContract
{
    public function getIndexData(GetIndexDataRequestContract $request, GetIndexDataResponseContract $response): GetIndexDataResponseContract
    {
        return $response;
    }
}
