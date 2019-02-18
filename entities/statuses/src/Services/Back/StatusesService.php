<?php

namespace InetStudio\SocialContest\Statuses\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;

/**
 * Class StatusesService.
 */
class StatusesService extends BaseService implements StatusesServiceContract
{
    /**
     * StatusesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Statuses\Contracts\Repositories\StatusesRepositoryContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return StatusModelContract
     */
    public function save(SaveStatusRequestContract $request, int $id): StatusModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        app()->make('InetStudio\Classifiers\Contracts\Services\Back\ClassifiersServiceContract')
            ->attachToObject($request, $item);

        event(app()->makeWith('InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyStatusEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Статус «'.$item->name.'» успешно '.$action);

        return $item;
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     * @param $type
     *
     * @return array
     */
    public function getSuggestions(string $search, $type): array
    {
        $items = $this->repository->searchItems([['name', 'LIKE', '%'.$search.'%']]);

        $resource = (app()->makeWith('InetStudio\SocialContest\Statuses\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $type,
        ]))->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($type && $type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return $data;
    }

    /**
     * Возвращаем статус по типу.
     *
     * @param string $type
     *
     * @return StatusModelContract|null
     */
    public function getStatusByType(string $type): ?StatusModelContract
    {
        return $this->repository->getItemsQuery()->whereHas('classifiers', function ($classifiersQuery) use ($type) {
            $classifiersQuery->where('classifiers.alias', $type);
        })->first();
    }
}
