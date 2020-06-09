<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Utility;

use InetStudio\SocialContest\Statuses\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract;

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
            'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract',
            compact('resource', 'type')
        );
    }
}
