<?php

namespace InetStudio\SocialContest\Posts\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class PostsBindingsServiceProvider.
 */
class PostsBindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract' => 'InetStudio\SocialContest\Posts\Repositories\PostsRepository',
        'InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract' => 'InetStudio\SocialContest\Posts\Models\PostModel',
        'InetStudio\SocialContest\Posts\Contracts\Transformers\Back\PostTransformerContract' => 'InetStudio\SocialContest\Posts\Transformers\Back\PostTransformer',
        'InetStudio\SocialContest\Posts\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\SocialContest\Posts\Transformers\Back\SuggestionTransformer',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\AddPostResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Posts\AddPostResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\DestroyResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Posts\DestroyResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\SaveResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Posts\SaveResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\ModerateResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Posts\ModerateResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\IndexResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Posts\IndexResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\FormResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Posts\FormResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\SavePostRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\SavePostRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsModerateControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\PostsModerateController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\PostsController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsExportControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\PostsExportController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsUtilityControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\PostsUtilityController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsDataControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\PostsDataController',
        'InetStudio\SocialContest\Posts\Contracts\Events\Back\SetWinnerEventContract' => 'InetStudio\SocialContest\Posts\Events\Back\SetWinnerEvent',
        'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyPostEventContract' => 'InetStudio\SocialContest\Posts\Events\Back\ModifyPostEvent',
        'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModeratePostEventContract' => 'InetStudio\SocialContest\Posts\Events\Back\ModeratePostEvent',
        'InetStudio\SocialContest\Posts\Contracts\Exports\PostsExportContract' => 'InetStudio\SocialContest\Posts\Exports\PostsExport',
        'InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsServiceContract' => 'InetStudio\SocialContest\Posts\Services\Back\PostsService',
        'InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsDataTableServiceContract' => 'InetStudio\SocialContest\Posts\Services\Back\PostsDataTableService',
        'InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsModerateServiceContract' => 'InetStudio\SocialContest\Posts\Services\Back\PostsModerateService',
        'InetStudio\SocialContest\Posts\Contracts\Services\Front\PostsServiceContract' => 'InetStudio\SocialContest\Posts\Services\Front\PostsService',
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
