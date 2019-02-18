<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsServiceContract;

/**
 * Class PostsService.
 */
class PostsService extends BaseService implements PostsServiceContract
{
    /**
     * PostsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract'));
    }

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return PostModelContract
     */
    public function save($data, int $id = 0): PostModelContract
    {
        $item = $this->repository->save($data, $id);

        event(app()->makeWith('InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyPostEventContract', [
            'object' => $item,
        ]));

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

        $resource = (app()->makeWith('InetStudio\SocialContest\Posts\Contracts\Transformers\Back\SuggestionTransformerContract', [
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
     * Создаем пост конкурса по посту из инстаграма.
     *
     * @param mixed $instagramPost
     *
     * @return PostModelContract
     */
    public function createPostFromInstagram($instagramPost): PostModelContract
    {
        if (! $instagramPost || get_class($instagramPost) !== 'InstagramAPI\Response\Model\Item') {
            return null;
        }

        $statusesService = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract');
        $instagramPostsService = app()->make('InetStudio\Instagram\Posts\Contracts\Services\Back\PostsServiceContract');
        $instagramUsersService = app()->make('InetStudio\Instagram\Users\Contracts\Services\Back\UsersServiceContract');

        $instagramUsersService->save($instagramPost->getUser());
        $savedInstagramPost = $instagramPostsService->save($instagramPost);

        $searchData = $savedInstagramPost->additional_info;
        Arr::forget($searchData, [
            'likers', 'caption.user', 'usertags', 'carousel_media',
            'location', 'image_versions2', 'preview_comments', 'video_versions',
        ]);

        $defaultStatus = $statusesService->getStatusByType('default');

        $item = $this->save([
            'hash' => Str::uuid(),
            'social_type' => get_class($savedInstagramPost),
            'social_id' => $savedInstagramPost->id,
            'status_id' => $defaultStatus->id ?? 1,
            'search_data' => $searchData,
        ]);

        return $item;
    }

    /**
     * Создаем пост конкурса по посту из вконтакте.
     *
     * @param array $vkontaktePost
     *
     * @return PostModelContract|null
     */
    public function createPostFromVkontakte(array $vkontaktePost): ?PostModelContract
    {
        if (empty($vkontaktePost) || ! isset($vkontaktePost['user'])) {
            return null;
        }

        $statusesService = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract');
        $vkontaktePostsService = app()->make('InetStudio\Vkontakte\Posts\Contracts\Services\Back\PostsServiceContract');
        $vkontakteUsersService = app()->make('InetStudio\Vkontakte\Users\Contracts\Services\Back\UsersServiceContract');

        $vkontakteUsersService->save($vkontaktePost['user']);
        $savedVkontaktePost = $vkontaktePostsService->save($vkontaktePost);

        $searchData = $savedVkontaktePost->additional_info;
        Arr::forget($searchData, [
            'attachments', 'likes', 'reposts', 'views',
            'post_source', 'comments',
        ]);

        $defaultStatus = $statusesService->getStatusByType('default');

        $item = $this->save([
            'hash' => Str::uuid(),
            'social_type' => get_class($savedVkontaktePost),
            'social_id' => $savedVkontaktePost->id,
            'status_id' => $defaultStatus->id ?? 1,
            'search_data' => $searchData,
        ]);

        return $item;
    }
}
