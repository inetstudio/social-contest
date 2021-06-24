<?php

namespace InetStudio\SocialContest\Prizes\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        'InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\SocialContest\Prizes\Events\Back\ModifyItemEvent',

        'InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Items\Attach\ItemDataContract' => 'InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\ItemData',
        'InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Items\Attach\PivotDataContract' => 'InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\PivotData',
        'InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Resource\Save\ItemDataContract' => 'InetStudio\SocialContest\Prizes\DTO\Back\Resource\Save\ItemData',

        'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\SocialContest\Prizes\Http\Controllers\Back\ResourceController',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\SocialContest\Prizes\Http\Controllers\Back\DataController',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\SocialContest\Prizes\Http\Controllers\Back\UtilityController',

        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Data\GetIndexDataRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\CreateRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\CreateRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\DestroyRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\DestroyRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\EditRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\EditRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\IndexRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\IndexRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\ShowRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\ShowRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\StoreRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\StoreRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\UpdateRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource\UpdateRequest',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Utility\GetSuggestionsRequestContract' => 'InetStudio\SocialContest\Prizes\Http\Requests\Back\Utility\GetSuggestionsRequest',

        'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract' => 'InetStudio\SocialContest\Prizes\Http\Resources\Back\Resource\Index\ItemResource',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract' => 'InetStudio\SocialContest\Prizes\Http\Resources\Back\Resource\Show\ItemResource',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Show\ItemsCollectionContract' => 'InetStudio\SocialContest\Prizes\Http\Resources\Back\Resource\Show\ItemsCollection',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\AutocompleteItemResourceContract' => 'InetStudio\SocialContest\Prizes\Http\Resources\Back\Utility\Suggestions\AutocompleteItemResource',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\ItemResourceContract' => 'InetStudio\SocialContest\Prizes\Http\Resources\Back\Utility\Suggestions\ItemResource',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract' => 'InetStudio\SocialContest\Prizes\Http\Resources\Back\Utility\Suggestions\ItemsCollection',

        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\StoreResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\StoreResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\UpdateResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource\UpdateResponse',
        'InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Utility\GetSuggestionsResponseContract' => 'InetStudio\SocialContest\Prizes\Http\Responses\Back\Utility\GetSuggestionsResponse',

        'InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract' => 'InetStudio\SocialContest\Prizes\Models\PrizeModel',

        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\DataTables\IndexService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\ItemsService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\ResourceService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Back\UtilityService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\SocialContest\Prizes\Services\Front\ItemsService',
        'InetStudio\SocialContest\Prizes\Contracts\Services\ItemsServiceContract' => 'InetStudio\SocialContest\Prizes\Services\ItemsService',
    ];

    public function provides()
    {
        return array_keys($this->bindings);
    }
}
