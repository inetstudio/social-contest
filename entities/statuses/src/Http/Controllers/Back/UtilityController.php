<?php

namespace InetStudio\SocialContest\Statuses\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Utility\SuggestionsRequestContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class UtilityController.
 */
class UtilityController extends Controller implements UtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param  SuggestionsRequestContract  $request
     * @param  SuggestionsResponseContract  $response
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(
        SuggestionsRequestContract $request,
        SuggestionsResponseContract $response
    ): SuggestionsResponseContract {
        return $response;
    }
}