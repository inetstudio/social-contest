<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

/**
 * Interface DataControllerContract.
 */
interface DataControllerContract
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
    ): GetIndexDataResponseContract;
}
