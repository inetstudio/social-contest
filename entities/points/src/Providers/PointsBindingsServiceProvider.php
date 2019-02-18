<?php

namespace InetStudio\SocialContest\Points\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class PointsBindingsServiceProvider.
 */
class PointsBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back\PointsControllerContract' => 'InetStudio\SocialContest\Points\Http\Controllers\Back\PointsController',
        'InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back\PointsDataControllerContract' => 'InetStudio\SocialContest\Points\Http\Controllers\Back\PointsDataController',
        'InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back\PointsUtilityControllerContract' => 'InetStudio\SocialContest\Points\Http\Controllers\Back\PointsUtilityController',
        'InetStudio\SocialContest\Points\Contracts\Events\Back\ModifyPointEventContract' => 'InetStudio\SocialContest\Points\Events\Back\ModifyPointEvent',
        'InetStudio\SocialContest\Points\Contracts\Models\PointModelContract' => 'InetStudio\SocialContest\Points\Models\PointModel',
        'InetStudio\SocialContest\Points\Contracts\Repositories\PointsRepositoryContract' => 'InetStudio\SocialContest\Points\Repositories\PointsRepository',
        'InetStudio\SocialContest\Points\Contracts\Http\Requests\Back\SavePointRequestContract' => 'InetStudio\SocialContest\Points\Http\Requests\Back\SavePointRequest',
        'InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\DestroyResponseContract' => 'InetStudio\SocialContest\Points\Http\Responses\Back\Points\DestroyResponse',
        'InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\FormResponseContract' => 'InetStudio\SocialContest\Points\Http\Responses\Back\Points\FormResponse',
        'InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\IndexResponseContract' => 'InetStudio\SocialContest\Points\Http\Responses\Back\Points\IndexResponse',
        'InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\SaveResponseContract' => 'InetStudio\SocialContest\Points\Http\Responses\Back\Points\SaveResponse',
        'InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\SocialContest\Points\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\SocialContest\Points\Contracts\Services\Back\PointsDataTableServiceContract' => 'InetStudio\SocialContest\Points\Services\Back\PointsDataTableService',
        'InetStudio\SocialContest\Points\Contracts\Services\Back\PointsObserverServiceContract' => 'InetStudio\SocialContest\Points\Services\Back\PointsObserverService',
        'InetStudio\SocialContest\Points\Contracts\Services\Back\PointsServiceContract' => 'InetStudio\SocialContest\Points\Services\Back\PointsService',
        'InetStudio\SocialContest\Points\Contracts\Services\Front\PointsServiceContract' => 'InetStudio\SocialContest\Points\Services\Front\PointsService',
        'InetStudio\SocialContest\Points\Contracts\Transformers\Back\PointTransformerContract' => 'InetStudio\SocialContest\Points\Transformers\Back\PointTransformer',
        'InetStudio\SocialContest\Points\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\SocialContest\Points\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
