<?php

namespace InetStudio\SocialContest\Stages\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Stages\Contracts\Models\StageModelContract;
use InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesServiceContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Requests\Back\SaveStageRequestContract;

/**
 * Class StagesService.
 */
class StagesService extends BaseService implements StagesServiceContract
{
    /**
     * StagesService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Stages\Contracts\Repositories\StagesRepositoryContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveStageRequestContract $request
     * @param int $id
     *
     * @return StageModelContract
     */
    public function save(SaveStageRequestContract $request, int $id): StageModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\SocialContest\Stages\Contracts\Events\Back\ModifyStageEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Этап «'.$item->name.'» успешно '.$action);

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

        $resource = (app()->makeWith('InetStudio\SocialContest\Stages\Contracts\Transformers\Back\SuggestionTransformerContract', [
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
