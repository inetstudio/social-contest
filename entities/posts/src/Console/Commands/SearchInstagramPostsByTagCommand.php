<?php

namespace InetStudio\SocialContest\Posts\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use InetStudio\SocialContest\Posts\DTO\ItemData;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByPK;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByTags;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByUserPK;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByCreatedGt;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByCreatedLt;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByMediaType;
use InetStudio\Instagram\Posts\Contracts\Services\Back\PostsServiceContract;
use InetStudio\Instagram\Users\Contracts\Services\Back\UsersServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchInstagramPostsByTagCommandContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

/**
 * Class SearchInstagramPostsByTagCommand.
 */
class SearchInstagramPostsByTagCommand extends Command implements SearchInstagramPostsByTagCommandContract
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $signature = 'inetstudio:social-contest:posts:instagram';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Search instagram posts by tag';

    /**
     * @var PostsServiceContract
     */
    protected PostsServiceContract $instagramPosts;

    /**
     * @var UsersServiceContract
     */
    protected UsersServiceContract $instagramUsers;

    /**
     * @var ItemsServiceContract
     */
    protected ItemsServiceContract $itemsService;

    protected StatusesServiceContract $statusesService;

    /**
     * SearchInstagramPostsByTagCommand constructor.
     *
     * @param  PostsServiceContract  $instagramPosts
     * @param  UsersServiceContract  $instagramUsers
     * @param  ItemsServiceContract  $itemsService
     * @param  StatusesServiceContract $statusesService
     */
    public function __construct(
        PostsServiceContract $instagramPosts,
        UsersServiceContract $instagramUsers,
        ItemsServiceContract $itemsService,
        StatusesServiceContract $statusesService
    ) {
        parent::__construct();

        $this->instagramPosts = $instagramPosts;
        $this->instagramUsers = $instagramUsers;
        $this->itemsService = $itemsService;
        $this->statusesService = $statusesService;
    }

    /**
     * Запуск команды.
     */
    public function handle(): void
    {
        $blockedUsersPKs = $this->getBlockedUsers();
        $existPKs = $this->instagramPosts->repository->getAllItems()->pluck('pk')->toArray();
        $mediaTypes = $this->getMediaTypes();
        $startTime = config('social_contest.start');
        $endTime = config('social_contest.end');
        $tags = config('social_contest.tags');

        foreach ($tags as $tagArr) {
            $socialPosts = $this->instagramPosts->getPostsByTag(
                $tagArr,
                [
                    'usersPKs' => new ByUserPK($blockedUsersPKs),
                    'PKs' => new ByPK($existPKs),
                    'mediaType' => new ByMediaType($mediaTypes),
                    'startTime' => new ByCreatedGt(($startTime) ? strtotime($startTime) : null),
                    'endTime' => new ByCreatedLt(($endTime) ? strtotime($endTime) : null),
                    'tags' => new ByTags($tagArr),
                ]
            );

            foreach ($socialPosts as $socialPost) {
                $this->instagramUsers->save($socialPost->getUser());
                $savedSocialPost = $this->instagramPosts->save($socialPost);

                $searchData = $savedSocialPost->additional_info;
                Arr::forget(
                    $searchData,
                    [
                        'likers', 'caption.user', 'usertags', 'carousel_media',
                        'location', 'image_versions2', 'preview_comments', 'video_versions',
                    ]
                );

                $defaultStatus = $this->statusesService->getItemsByType('default')->first();

                $data = new ItemData(
                    [
                        'uuid' => Str::uuid(),
                        'social_type' => get_class($savedSocialPost),
                        'social_id' => $savedSocialPost->id,
                        'status_id' => $defaultStatus->id ?? 1,
                        'search_data' => $searchData,
                    ]
                );

                $this->itemsService->save($data);
            }
        }
    }

    /**
     * Возвращаем типы медиа-контента.
     *
     * @return array
     */
    protected function getMediaTypes(): array
    {
        $configTypes = config('social_contest.types');
        $mediaTypes = [];

        foreach ($configTypes ?? [] as $configType) {
            switch ($configType) {
                case 'all':
                    $mediaTypes = [1, 2, 8];
                    break;
                case 'photo':
                    $mediaTypes[] = 1;
                    break;
                case 'video':
                    $mediaTypes[] = 2;
                    break;
            }
        }

        return $mediaTypes;
    }

    /**
     * Возвращаем PK заблокированных пользователей.
     *
     * @return array
     */
    protected function getBlockedUsers(): array
    {
        $blockStatus = $this->statusesService->getModel()->where('alias', '=', 'blocked')->first();

        if ($blockStatus) {
            $blockedPosts = $this->itemsService->getItemsByStatus($blockStatus);
            $userIds = [];

            foreach ($blockedPosts as $blockedPost) {
                if ($blockedPost->social->social_name !== 'instagram') {
                    continue;
                }

                $userIds[] = $blockedPost->social->user->pk;
            }

            return array_unique($userIds);
        }

        return [];
    }
}
