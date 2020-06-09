<?php

namespace InetStudio\SocialContest\Prizes\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Utility\GetSuggestionsRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract;

class UtilityController extends Controller implements UtilityControllerContract
{
    public function getSuggestions(GetSuggestionsRequestContract $request, GetSuggestionsResponseContract $response): GetSuggestionsResponseContract
    {
        return $response;
    }
}
