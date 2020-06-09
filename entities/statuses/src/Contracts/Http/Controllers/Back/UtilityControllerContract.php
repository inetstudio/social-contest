<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Utility\GetSuggestionsRequestContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract;

interface UtilityControllerContract
{
    public function getSuggestions(GetSuggestionsRequestContract $request, GetSuggestionsResponseContract $response): GetSuggestionsResponseContract;
}
