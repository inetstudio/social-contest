<?php

namespace InetStudio\SocialContest\Tags\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract;
use InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsServiceContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract;

/**
 * Class TagsService.
 */
class TagsService extends BaseService implements TagsServiceContract
{
    /**
     * TagsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Tags\Contracts\Repositories\TagsRepositoryContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveTagRequestContract $request
     * @param int $id
     *
     * @return TagModelContract
     */
    public function save(SaveTagRequestContract $request, int $id): TagModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\SocialContest\Tags\Contracts\Events\Back\ModifyTagEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Тег «'.$item->name.'» успешно '.$action);

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

        $resource = (app()->makeWith('InetStudio\SocialContest\Tags\Contracts\Transformers\Back\SuggestionTransformerContract', [
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
