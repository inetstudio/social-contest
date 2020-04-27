<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Utility\SuggestionsRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

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
