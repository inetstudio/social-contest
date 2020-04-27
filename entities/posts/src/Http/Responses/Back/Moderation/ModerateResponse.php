<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Moderation;

use Illuminate\Http\Request;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Moderation\ModerateResponseContract;

class ModerateResponse implements ModerateResponseContract
{
    protected ModerateServiceContract $moderateService;

    public function __construct(ModerateServiceContract $moderateService)
    {
        $this->moderateService = $moderateService;
    }

    /**
     * Возвращаем ответ при модерации объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     *
     * @throws BindingResolutionException
     */
    public function toResponse($request)
    {
        $id = $request->route('id', 0);
        $alias = $request->route('alias', '');
        $data = $request->input('additional_info', []);

        $resource = $this->moderateService->moderate($id, $alias, $data);

        return app()->make(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemsCollectionContract',
            compact('resource')
        );
    }
}
