<?php

namespace InetStudio\SocialContest\Statuses\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract;

/**
 * Class StatusesUtilityController.
 */
class StatusesUtilityController extends Controller implements StatusesUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * ArticlesUtilityController constructor.
     */
    public function __construct()
    {
        $this->services['statuses'] = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract');
    }

    /**
     * Возвращаем статьи для поля.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSuggestions(Request $request): JsonResponse
    {
        $search = $request->get('q');
        $type = $request->get('type');

        $data = $this->services['statuses']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
