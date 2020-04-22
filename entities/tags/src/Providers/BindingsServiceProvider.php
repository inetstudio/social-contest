<?php

namespace InetStudio\SocialContest\Tags\Providers;

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
        'InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back\TagsControllerContract' => 'InetStudio\SocialContest\Tags\Http\Controllers\Back\TagsController',
        'InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back\TagsDataControllerContract' => 'InetStudio\SocialContest\Tags\Http\Controllers\Back\TagsDataController',
        'InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back\TagsUtilityControllerContract' => 'InetStudio\SocialContest\Tags\Http\Controllers\Back\TagsUtilityController',
        'InetStudio\SocialContest\Tags\Contracts\Events\Back\ModifyTagEventContract' => 'InetStudio\SocialContest\Tags\Events\Back\ModifyTagEvent',
        'InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract' => 'InetStudio\SocialContest\Tags\Models\TagModel',
        'InetStudio\SocialContest\Tags\Contracts\Repositories\TagsRepositoryContract' => 'InetStudio\SocialContest\Tags\Repositories\TagsRepository',
        'InetStudio\SocialContest\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract' => 'InetStudio\SocialContest\Tags\Http\Requests\Back\SaveTagRequest',
        'InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\SocialContest\Tags\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\SocialContest\Tags\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\SocialContest\Tags\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\SocialContest\Tags\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\SocialContest\Tags\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsDataTableServiceContract' => 'InetStudio\SocialContest\Tags\Services\Back\TagsDataTableService',
        'InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsObserverServiceContract' => 'InetStudio\SocialContest\Tags\Services\Back\TagsObserverService',
        'InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsServiceContract' => 'InetStudio\SocialContest\Tags\Services\Back\TagsService',
        'InetStudio\SocialContest\Tags\Contracts\Services\Front\TagsServiceContract' => 'InetStudio\SocialContest\Tags\Services\Front\TagsService',
        'InetStudio\SocialContest\Tags\Contracts\Transformers\Back\TagTransformerContract' => 'InetStudio\SocialContest\Tags\Transformers\Back\TagTransformer',
        'InetStudio\SocialContest\Tags\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\SocialContest\Tags\Transformers\Back\SuggestionTransformer',
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