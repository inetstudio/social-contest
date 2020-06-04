<?php

namespace InetStudio\SocialContest\Posts\Providers;

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
    public array $bindings = [
        'InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchInstagramPostsByTagCommandContract' => 'InetStudio\SocialContest\Posts\Console\Commands\SearchInstagramPostsByTagCommand',
        'InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchInstagramStoriesByTagCommandContract' => 'InetStudio\SocialContest\Posts\Console\Commands\SearchInstagramStoriesByTagCommand',
        'InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchVkontaktePostsByTagCommandContract' => 'InetStudio\SocialContest\Posts\Console\Commands\SearchVkontaktePostsByTagCommand',
        'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModerateItemEventContract' => 'InetStudio\SocialContest\Posts\Events\Back\ModerateItemEvent',
        'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\SocialContest\Posts\Events\Back\ModifyItemEvent',
        'InetStudio\SocialContest\Posts\Contracts\Events\Back\SetWinnerEventContract' => 'InetStudio\SocialContest\Posts\Events\Back\SetWinnerEvent',
        'InetStudio\SocialContest\Posts\Contracts\Exports\ItemsExportContract' => 'InetStudio\SocialContest\Posts\Exports\ItemsExport',
        'InetStudio\SocialContest\Posts\Contracts\DTO\ItemDataContract' => 'InetStudio\SocialContest\Posts\DTO\ItemData',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\DataController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ExportControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\ExportController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ModerateControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\ModerateController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\SocialContest\Posts\Http\Controllers\Back\ResourceController',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Data\GetIndexDataRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Moderation\ModerateRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Moderation\ModerateRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\CreateRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\CreateRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\DestroyRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\DestroyRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\EditRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\EditRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\IndexRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\IndexRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\ShowRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\ShowRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\StoreRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\StoreRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\UpdateRequestContract' => 'InetStudio\SocialContest\Posts\Http\Requests\Back\Resource\UpdateRequest',
        'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemResourceContract' => 'InetStudio\SocialContest\Posts\Http\Resources\Back\Moderation\ItemResource',
        'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemsCollectionContract' => 'InetStudio\SocialContest\Posts\Http\Resources\Back\Moderation\ItemsCollection',
        'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract' => 'InetStudio\SocialContest\Posts\Http\Resources\Back\Resource\Index\ItemResource',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Export\ItemsExportResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Moderation\ModerateResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Moderation\ModerateResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\StoreResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\StoreResponse',
        'InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\UpdateResponseContract' => 'InetStudio\SocialContest\Posts\Http\Responses\Back\Resource\UpdateResponse',
        'InetStudio\SocialContest\Posts\Contracts\Listeners\Back\SetWinnerListenerContract' => 'InetStudio\SocialContest\Posts\Listeners\Back\SetWinnerListener',
        'InetStudio\SocialContest\Posts\Contracts\Listeners\ItemStatusChangeListenerContract' => 'InetStudio\SocialContest\Posts\Listeners\ItemStatusChangeListener',
        'InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract' => 'InetStudio\SocialContest\Posts\Models\PostModel',
        'InetStudio\SocialContest\Posts\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\SocialContest\Posts\Services\Back\DataTables\IndexService',
        'InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\SocialContest\Posts\Services\Back\ItemsService',
        'InetStudio\SocialContest\Posts\Contracts\Services\Back\ModerateServiceContract' => 'InetStudio\SocialContest\Posts\Services\Back\ModerateService',
        'InetStudio\SocialContest\Posts\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\SocialContest\Posts\Services\Front\ItemsService',
        'InetStudio\SocialContest\Posts\Contracts\Services\ItemsServiceContract' => 'InetStudio\SocialContest\Posts\Services\ItemsService',
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
