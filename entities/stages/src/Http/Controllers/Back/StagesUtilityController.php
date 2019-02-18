<?php

namespace InetStudio\SocialContest\Stages\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back\StagesUtilityControllerContract;

/**
 * Class StagesUtilityController.
 */
class StagesUtilityController extends Controller implements StagesUtilityControllerContract
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
        $this->services['stages'] = app()->make('InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesServiceContract');
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

        $data = $this->services['stages']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
