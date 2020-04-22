<?php

namespace InetStudio\SocialContest\Prizes\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\PrizesControllerContract' => 'InetStudio\SocialContest\Prizes\Http\Controllers\Back\PrizesController',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\PrizesDataControllerContract' => 'InetStudio\SocialContest\Prizes\Http\Controllers\Back\PrizesDataController',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\PrizesUtilityControllerContract' => 'InetStudio\SocialContest\Prizes\Http\Controllers\Back\PrizesUtilityController',
        'InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyPrizeEventContract' => 'InetStudio\SocialContest\Prizes\Events\Back\ModifyPrizeEvent',
        'InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract' => 'InetStudio\SocialContest\Prizes\Models\PrizeModel',
        'InetStudio\SocialContest\Prizes\Contracts\Repositories\PrizesRepositoryContract' => 'InetStudio\SocialContest\Prizes\Repositories\PrizesRepository',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\SavePrizeRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\SavePrizeRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesDataTableServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\PrizesDataTableService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesObserverServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\PrizesObserverService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\PrizesService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Front\PrizesServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Front\PrizesService',
        'InetStudio\SocialContest\Prizes\Contracts\Transformers\Back\PrizeTransformerContract' => 'InetStudio\SocialContest\Prizes\Transformers\Back\PrizeTransformer',
        'InetStudio\SocialContest\Prizes\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\SocialContest\Prizes\Transformers\Back\SuggestionTransformer',
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
