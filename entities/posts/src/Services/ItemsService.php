<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\Services;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

/**
 * Class ItemsService.
 */
class ItemsService implements ItemsServiceContract
{
    /**
     * @var PostModelContract
     */
    protected PostModelContract $model;

    /**
     * ItemsService constructor.
     *
     * @param  PostModelContract  $model
     */
    public function __construct(PostModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Возвращаем модель.
     *
     * @return PostModelContract
     */
    public function getModel(): PostModelContract
    {
        return $this->model;
    }

    /**
     * Создаем модель.
     *
     * @return PostModelContract
     */
    public function create(): PostModelContract
    {
        return new $this->model;
    }

    /**
     * Получаем объект по id.
     *
     * @param  mixed  $id
     * @param  bool  $returnNew
     *
     * @return mixed
     */
    public function getItemById($id = 0, bool $returnNew = true)
    {
        return $this->model::find($id) ?? (($returnNew) ? $this->create() : null);
    }

    /**
     * Получаем объекты по статусу.
     *
     * @param  StatusModelContract  $status
     *
     * @return Collection
     */
    public function getItemsByStatus(StatusModelContract $status): Collection
    {
        return $this->model::with('social', 'social.media', 'social.user')->where('status_id', $status['id'])->get();
    }
}
