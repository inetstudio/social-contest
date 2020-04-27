<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\DataControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

/**
 * Class DataController.
 */
class DataController extends Controller implements DataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param  GetIndexDataRequestContract  $request
     * @param  GetIndexDataResponseContract  $response
     *
     * @return GetIndexDataResponseContract
     */
    public function getIndexData(
        GetIndexDataRequestContract $request,
        GetIndexDataResponseContract $response
    ): GetIndexDataResponseContract {
        return $response;
    }
}
