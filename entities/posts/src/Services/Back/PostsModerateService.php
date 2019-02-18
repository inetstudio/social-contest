<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Services\Back\BaseService;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsModerateServiceContract;

/**
 * Class PostsModerateService.
 */
class PostsModerateService extends BaseService implements PostsModerateServiceContract
{
    /**
     * PostsModerateService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract'));
    }

    /**
     * Модерация чека.
     *
     * @param int $id
     * @param string $statusAlias
     *
     * @return Collection
     */
    public function moderate(int $id, string $statusAlias): Collection
    {
        $items = collect([]);

        $item = $this->getItemById($id);
        $status = app()->make('InetStudio\SocialContest\Statuses\Contracts\Repositories\StatusesRepositoryContract')
            ->searchItems([['alias', '=', $statusAlias]])->first();

        if (! $item->id || ! $status) {
            return $items;
        }

        $items->push($item);
        if ($status->classifiers->contains('alias', 'block')) {
            $userSocialPosts = $item->social->user->posts;

            $userPosts = $this->repository->getItemsQuery()
                ->whereIn('social_id', $userSocialPosts->pluck('id')->toArray())
                ->where('social_type', get_class($userSocialPosts->first()))
                ->get();

            $userPosts->each(function ($userPost) use ($items) {
                $items->push($userPost);
            });
        }

        $items = $items->unique('hash')
            ->map(function ($item) use ($status) {
                $savedItem = $this->repository->save([
                    'status_id' => $status->id,
                ], $item->id)->fresh();

                event(app()->makeWith('InetStudio\SocialContest\Posts\Contracts\Events\Back\ModeratePostEventContract', [
                    'object' => $savedItem,
                ]));

                return $savedItem;
            });

        return $items;
    }
}
