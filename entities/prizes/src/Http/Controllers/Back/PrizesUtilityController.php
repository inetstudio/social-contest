<?php

namespace InetStudio\SocialContest\Prizes\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\PrizesUtilityControllerContract;

/**
 * Class PrizesUtilityController.
 */
class PrizesUtilityController extends Controller implements PrizesUtilityControllerContract
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
        $this->services['prizes'] = app()->make('InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesServiceContract');
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

        $data = $this->services['prizes']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
