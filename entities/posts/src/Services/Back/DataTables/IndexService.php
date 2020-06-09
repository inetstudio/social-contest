<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\Services\Back\DataTables;

use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\DataTables\IndexServiceContract;

class IndexService extends DataTable implements IndexServiceContract
{
    protected PostModelContract $model;

    protected $resource;

    public function __construct(PostModelContract $model)
    {
        $this->model = $model;
        $this->resource = resolve(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract',
            [
                'resource' => null,
            ]
        );
    }

    public function ajax(): JsonResponse
    {
        return DataTables::of($this->query())
            ->setTransformer(function ($item) {
                return $this->resource::make($item)->resolve();
            })
            ->rawColumns(['status', 'moderation', 'social', 'actions'])
            ->make();
    }

    public function query()
    {
        return $this->model::query()->with(['prizes', 'social', 'status']);
    }

    public function html(): Builder
    {
        /** @var Builder $table */
        $table = resolve('datatables.html');

        return $table
            ->columns($this->getColumns())
            ->ajax($this->getAjaxOptions())
            ->parameters($this->getParameters());
    }

    protected function getColumns(): array
    {
        return [
            ['data' => 'search_data', 'name' => 'search_data', 'title' => 'Search', 'orderable' => false, 'visible' => false, 'className' => 'post-search_data'],
            ['data' => 'uuid', 'name' => 'uuid', 'title' => 'uuid', 'visible' => false, 'className' => 'post-uuid'],
            ['data' => 'id', 'name' => 'id', 'title' => 'ID', 'className' => 'post-id'],
            ['data' => 'status', 'name' => 'status.name', 'title' => 'Статус', 'orderable' => false, 'className' => 'post-status'],
            ['data' => 'moderation', 'name' => 'moderation', 'title' => 'Модерация', 'orderable' => false, 'searchable' => false, 'className' => 'post-moderation'],
            ['data' => 'prizes', 'name' => 'prizes.name', 'title' => 'Призы', 'orderable' => false, 'className' => 'post-prizes'],
            ['data' => 'media', 'name' => 'media', 'title' => 'Медиа', 'orderable' => false, 'searchable' => false, 'className' => 'post-media'],
            ['data' => 'info', 'name' => 'info', 'title' => 'Инфо', 'orderable' => false, 'searchable' => false, 'className' => 'post-info'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания', 'className' => 'post-created_at'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Дата обновления', 'className' => 'post-updated_at'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false, 'className' => 'post-actions'],
        ];
    }

    protected function getAjaxOptions(): array
    {
        return [
            'url' => route('back.social-contest.posts.data.index'),
            'type' => 'POST',
        ];
    }

    protected function getParameters(): array
    {
        $translation = trans('admin::datatables');

        return [
            'order' => [8, 'desc'],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $translation,
        ];
    }
}
