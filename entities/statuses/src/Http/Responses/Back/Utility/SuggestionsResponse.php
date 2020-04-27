<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Utility;

use Illuminate\Http\Request;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class SuggestionsResponse.
 */
class SuggestionsResponse implements SuggestionsResponseContract
{
    /**
     * @var UtilityServiceContract
     */
    protected UtilityServiceContract $utilityService;

    /**
     * CreateResponse constructor.
     *
     * @param  UtilityServiceContract  $utilityService
     */
    public function __construct(UtilityServiceContract $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    /**
     * Возвращаем подсказки для поля.
     *
     * @param  Request  $request
     *
     * @return \InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract|mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws BindingResolutionException
     */
    public function toResponse($request)
    {
        $search = $request->get('q', '') ?? '';
        $type = $request->get('type', '') ?? '';

        $resource = $this->utilityService->getSuggestions($search);

        return app()->make(
            'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract',
            compact('resource', 'type')
        );
    }
}
