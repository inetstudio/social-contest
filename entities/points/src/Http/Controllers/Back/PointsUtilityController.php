<?php

namespace InetStudio\SocialContest\Points\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back\PointsUtilityControllerContract;

/**
 * Class PointsUtilityController.
 */
class PointsUtilityController extends Controller implements PointsUtilityControllerContract
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
        $this->services['points'] = app()->make('InetStudio\SocialContest\Points\Contracts\Services\Back\PointsServiceContract');
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

        $data = $this->services['points']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
