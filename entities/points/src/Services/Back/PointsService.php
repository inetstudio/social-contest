<?php

namespace InetStudio\SocialContest\Points\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Points\Contracts\Models\PointModelContract;
use InetStudio\SocialContest\Points\Contracts\Services\Back\PointsServiceContract;
use InetStudio\SocialContest\Points\Contracts\Http\Requests\Back\SavePointRequestContract;

/**
 * Class PointsService.
 */
class PointsService extends BaseService implements PointsServiceContract
{
    /**
     * PointsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Points\Contracts\Repositories\PointsRepositoryContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param SavePointRequestContract $request
     * @param int $id
     *
     * @return PointModelContract
     */
    public function save(SavePointRequestContract $request, int $id): PointModelContract
    {
        $action = ($id) ? 'отредактированы' : 'созданы';

        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\SocialContest\Points\Contracts\Events\Back\ModifyPointEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Баллы «'.$item->name.'» успешно '.$action);

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

        $resource = (app()->makeWith('InetStudio\SocialContest\Points\Contracts\Transformers\Back\SuggestionTransformerContract', [
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
}
