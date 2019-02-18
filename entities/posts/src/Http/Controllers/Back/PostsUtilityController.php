<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsUtilityControllerContract;

/**
 * Class PostsUtilityController.
 */
class PostsUtilityController extends Controller implements PostsUtilityControllerContract
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
        $this->services['posts'] = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsServiceContract');
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

        $data = $this->services['posts']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
