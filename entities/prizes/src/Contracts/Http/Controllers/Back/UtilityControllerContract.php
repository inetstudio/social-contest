<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Utility\GetSuggestionsRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract;

interface UtilityControllerContract
{
    public function getSuggestions(GetSuggestionsRequestContract $request, GetSuggestionsResponseContract $response): GetSuggestionsResponseContract;
}
