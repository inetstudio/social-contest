<?php

namespace InetStudio\SocialContest\Statuses\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        'InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\SocialContest\Statuses\Events\Back\ModifyItemEvent',

        'InetStudio\SocialContest\Statuses\Contracts\DTO\Back\Resource\Save\ItemDataContract' => 'InetStudio\SocialContest\Statuses\DTO\Back\Resource\Save\ItemData',

        'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\SocialContest\Statuses\Http\Controllers\Back\ResourceController',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\SocialContest\Statuses\Http\Controllers\Back\DataController',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\SocialContest\Statuses\Http\Controllers\Back\UtilityController',

        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Data\GetIndexDataRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\CreateRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\CreateRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\DestroyRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\DestroyRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\EditRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\EditRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\IndexRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\IndexRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\ShowRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\ShowRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\StoreRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\StoreRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\UpdateRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource\UpdateRequest',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Utility\GetSuggestionsRequestContract' => 'InetStudio\SocialContest\Statuses\Http\Requests\Back\Utility\GetSuggestionsRequest',

        'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract' => 'InetStudio\SocialContest\Statuses\Http\Resources\Back\Resource\Index\ItemResource',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract' => 'InetStudio\SocialContest\Statuses\Http\Resources\Back\Resource\Show\ItemResource',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\AutocompleteItemResourceContract' => 'InetStudio\SocialContest\Statuses\Http\Resources\Back\Utility\Suggestions\AutocompleteItemResource',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemResourceContract' => 'InetStudio\SocialContest\Statuses\Http\Resources\Back\Utility\Suggestions\ItemResource',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract' => 'InetStudio\SocialContest\Statuses\Http\Resources\Back\Utility\Suggestions\ItemsCollection',

        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\StoreResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\StoreResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\UpdateResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource\UpdateResponse',
        'InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract' => 'InetStudio\SocialContest\Statuses\Http\Responses\Back\Utility\GetSuggestionsResponse',

        'InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract' => 'InetStudio\SocialContest\Statuses\Models\StatusModel',

        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\DataTables\IndexService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\ItemsService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\ResourceServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\ResourceService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Back\UtilityService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\SocialContest\Statuses\Services\Front\ItemsService',
        'InetStudio\SocialContest\Statuses\Contracts\Services\ItemsServiceContract' => 'InetStudio\SocialContest\Statuses\Services\ItemsService',
    ];

    public function provides()
    {
        return array_keys($this->bindings);
    }
}
