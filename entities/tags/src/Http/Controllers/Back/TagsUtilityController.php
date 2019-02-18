<?php

namespace InetStudio\SocialContest\Tags\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back\TagsUtilityControllerContract;

/**
 * Class TagsUtilityController.
 */
class TagsUtilityController extends Controller implements TagsUtilityControllerContract
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
        $this->services['tags'] = app()->make('InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsServiceContract');
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

        $data = $this->services['tags']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
