<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\Services\Back\DataTables;

use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\DataTables\IndexServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract;

/**
 * Class IndexService.
 */
class IndexService extends DataTable implements IndexServiceContract
{
    /**
     * @var PostModelContract
     */
    protected PostModelContract $model;

    /**
     * @var ItemResourceContract
     */
    protected $resource;

    /**
     * IndexService constructor.
     *
     * @param  PostModelContract  $model
     *
     * @throws BindingResolutionException
     */
    public function __construct(PostModelContract $model)
    {
        $this->model = $model;
        $this->resource = app()->make(
            ItemResourceContract::class,
            [
                'resource' => null,
            ]
        );
    }

    /**
     * Запрос на получение данных таблицы.
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function ajax(): JsonResponse
    {
        return DataTables::of($this->query())
            ->setTransformer(function ($item) {
                return $this->resource::make($item)->resolve();
            })
            ->rawColumns(['status', 'moderation', 'social', 'actions'])
            ->make();
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        return $this->model::query()->with(['social', 'status']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        /** @var Builder $table */
        $table = app('datatables.html');

        return $table
            ->columns($this->getColumns())
            ->ajax($this->getAjaxOptions())
            ->parameters($this->getParameters());
    }

    /**
     * Получаем колонки.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            ['data' => 'search_data', 'name' => 'search_data', 'title' => 'Search', 'orderable' => false, 'visible' => false, 'className' => 'post-search_data'],
            ['data' => 'status', 'name' => 'status.name', 'title' => 'Статус', 'orderable' => false, 'className' => 'post-status'],
            ['data' => 'moderation', 'name' => 'moderation', 'title' => 'Модерация', 'orderable' => false, 'searchable' => false, 'className' => 'post-moderation'],
            ['data' => 'media', 'name' => 'media', 'title' => 'Медиа', 'orderable' => false, 'searchable' => false, 'className' => 'post-media'],
            ['data' => 'info', 'name' => 'info', 'title' => 'Инфо', 'orderable' => false, 'searchable' => false, 'className' => 'post-info'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания', 'className' => 'post-created_at'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Дата обновления', 'className' => 'post-updated_at'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false, 'className' => 'post-actions'],
        ];
    }

    /**
     * Свойства ajax datatables.
     *
     * @return array
     */
    protected function getAjaxOptions(): array
    {
        return [
            'url' => route('back.social-contest.posts.data.index'),
            'type' => 'POST',
        ];
    }

    /**
     * Свойства datatables.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $translation = trans('admin::datatables');

        return [
            'order' => [5, 'desc'],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $translation,
        ];
    }
}
