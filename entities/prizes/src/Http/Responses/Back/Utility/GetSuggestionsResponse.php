<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Utility;

use InetStudio\SocialContest\Prizes\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract;

class GetSuggestionsResponse implements GetSuggestionsResponseContract
{
    protected UtilityServiceContract $utilityService;

    public function __construct(UtilityServiceContract $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    public function toResponse($request)
    {
        $search = $request->get('q', '') ?? '';
        $type = $request->get('type', '') ?? '';

        $resource = $this->utilityService->getSuggestions($search);

        return resolve(
            'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract',
            compact('resource', 'type')
        );
    }
}
