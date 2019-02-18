<?php

namespace InetStudio\SocialContest\Prizes\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\SavePrizeRequestContract;

/**
 * Class PrizesService.
 */
class PrizesService extends BaseService implements PrizesServiceContract
{
    /**
     * PrizesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Prizes\Contracts\Repositories\PrizesRepositoryContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param SavePrizeRequestContract $request
     * @param int $id
     *
     * @return PrizeModelContract
     */
    public function save(SavePrizeRequestContract $request, int $id): PrizeModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyPrizeEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Приз «'.$item->name.'» успешно '.$action);

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

        $resource = (app()->makeWith('InetStudio\SocialContest\Prizes\Contracts\Transformers\Back\SuggestionTransformerContract', [
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
