<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Statuses\Services;

use Illuminate\Database\Eloquent\Collection;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService implements ItemsServiceContract
{
    /**
     * @var StatusModelContract
     */
    protected StatusModelContract $model;

    /**
     * ItemsService constructor.
     *
     * @param  StatusModelContract  $model
     */
    public function __construct(StatusModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Возвращаем модель.
     *
     * @return StatusModelContract
     */
    public function getModel(): StatusModelContract
    {
        return $this->model;
    }

    /**
     * Создаем модель.
     *
     * @return StatusModelContract
     */
    public function create(): StatusModelContract
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
     * Возвращаем статусы по типу.
     *
     * @param  string  $type
     *
     * @return Collection
     */
    public function getItemsByType(string $type): Collection
    {
        return $this->model::whereHas(
            'classifiers',
            function ($classifiersQuery) use ($type) {
                $classifiersQuery->select(['classifiers_entries.id', 'classifiers_entries.alias'])
                    ->where('classifiers_entries.alias', 'social_contest_status_'.$type);
            }
        )->get();
    }
}
