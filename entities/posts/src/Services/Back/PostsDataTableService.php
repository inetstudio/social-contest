<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsDataTableServiceContract;

/**
 * Class PostsDataTableService.
 */
class PostsDataTableService extends DataTable implements PostsDataTableServiceContract
{
    /**
     * @var PostsRepositoryContract
     */
    protected $repository;

    /**
     * PostsDataTableService constructor.
     *
     * @param PostsRepositoryContract $repository
     */
    public function __construct(PostsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Запрос на получение данных таблицы.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function ajax()
    {
        $transformer = app()->make('InetStudio\SocialContest\Posts\Contracts\Transformers\Back\PostTransformerContract');

        return DataTables::of($this->query())
            ->setTransformer($transformer)
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
        $query = $this->repository->getItemsQuery([
            'columns' => ['hash', 'search_data', 'created_at', 'updated_at'],
            'relations' => ['social', 'status']
        ]);

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): Builder
    {
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
            ['data' => 'search_data', 'name' => 'search_data', 'title' => 'Search', 'orderable' => false, 'visible' => false],
            ['data' => 'status', 'name' => 'status.name', 'title' => 'Статус', 'orderable' => false],
            ['data' => 'moderation', 'name' => 'moderation', 'title' => 'Модерация', 'orderable' => false, 'searchable' => false],
            ['data' => 'media', 'name' => 'media', 'title' => 'Медиа', 'orderable' => false, 'searchable' => false],
            ['data' => 'info', 'name' => 'info', 'title' => 'Инфо', 'orderable' => false, 'searchable' => false],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Дата обновления'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false],
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
        $i18n = trans('admin::datatables');

        return [
            'order' => [
                5,
                'desc'
            ],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $i18n,
        ];
    }
}
