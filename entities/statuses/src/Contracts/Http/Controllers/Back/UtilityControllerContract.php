<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Utility\SuggestionsRequestContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
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
    ): SuggestionsResponseContract;
}
