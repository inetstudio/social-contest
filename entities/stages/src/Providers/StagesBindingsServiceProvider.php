<?php

namespace InetStudio\SocialContest\Stages\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class StagesBindingsServiceProvider.
 */
class StagesBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back\StagesControllerContract' => 'InetStudio\SocialContest\Stages\Http\Controllers\Back\StagesController',
        'InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back\StagesDataControllerContract' => 'InetStudio\SocialContest\Stages\Http\Controllers\Back\StagesDataController',
        'InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back\StagesUtilityControllerContract' => 'InetStudio\SocialContest\Stages\Http\Controllers\Back\StagesUtilityController',
        'InetStudio\SocialContest\Stages\Contracts\Events\Back\ModifyStageEventContract' => 'InetStudio\SocialContest\Stages\Events\Back\ModifyStageEvent',
        'InetStudio\SocialContest\Stages\Contracts\Models\StageModelContract' => 'InetStudio\SocialContest\Stages\Models\StageModel',
        'InetStudio\SocialContest\Stages\Contracts\Repositories\StagesRepositoryContract' => 'InetStudio\SocialContest\Stages\Repositories\StagesRepository',
        'InetStudio\SocialContest\Stages\Contracts\Http\Requests\Back\SaveStageRequestContract' => 'InetStudio\SocialContest\Stages\Http\Requests\Back\SaveStageRequest',
        'InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\DestroyResponseContract' => 'InetStudio\SocialContest\Stages\Http\Responses\Back\Stages\DestroyResponse',
        'InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\FormResponseContract' => 'InetStudio\SocialContest\Stages\Http\Responses\Back\Stages\FormResponse',
        'InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\IndexResponseContract' => 'InetStudio\SocialContest\Stages\Http\Responses\Back\Stages\IndexResponse',
        'InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\SaveResponseContract' => 'InetStudio\SocialContest\Stages\Http\Responses\Back\Stages\SaveResponse',
        'InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\SocialContest\Stages\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesDataTableServiceContract' => 'InetStudio\SocialContest\Stages\Services\Back\StagesDataTableService',
        'InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesObserverServiceContract' => 'InetStudio\SocialContest\Stages\Services\Back\StagesObserverService',
        'InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesServiceContract' => 'InetStudio\SocialContest\Stages\Services\Back\StagesService',
        'InetStudio\SocialContest\Stages\Contracts\Services\Front\StagesServiceContract' => 'InetStudio\SocialContest\Stages\Services\Front\StagesService',
        'InetStudio\SocialContest\Stages\Contracts\Transformers\Back\StageTransformerContract' => 'InetStudio\SocialContest\Stages\Transformers\Back\StageTransformer',
        'InetStudio\SocialContest\Stages\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\SocialContest\Stages\Transformers\Back\SuggestionTransformer',
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
