<?php

namespace InetStudio\SocialContest\Statuses\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class StatusesBindingsServiceProvider.
 */
class StatusesBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract' => 'InetStudio\SocialContest\Statuses\Http\Controllers\Back\StatusesController',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract' => 'InetStudio\SocialContest\Statuses\Http\Controllers\Back\StatusesDataController',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract' => 'InetStudio\SocialContest\Statuses\Http\Controllers\Back\StatusesUtilityController',
        'InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyStatusEventContract' => 'InetStudio\SocialContest\Statuses\Events\Back\ModifyStatusEvent',
        'InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract' => 'InetStudio\SocialContest\Statuses\Models\StatusModel',
        'InetStudio\SocialContest\Statuses\Contracts\Repositories\StatusesRepositoryContract' => 'InetStudio\SocialContest\Statuses\Repositories\StatusesRepository',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\SaveStatusRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\DestroyResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Statuses\DestroyResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Statuses\FormResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Statuses\IndexResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Statuses\SaveResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\StatusesDataTableService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesObserverServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\StatusesObserverService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\StatusesService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Front\StatusesServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Front\StatusesService',
        'InetStudio\SocialContest\Statuses\Contracts\Transformers\Back\StatusTransformerContract' => 'InetStudio\SocialContest\Statuses\Transformers\Back\StatusTransformer',
        'InetStudio\SocialContest\Statuses\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\SocialContest\Statuses\Transformers\Back\SuggestionTransformer',
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
