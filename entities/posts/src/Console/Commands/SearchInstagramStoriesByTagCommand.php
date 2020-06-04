<?php

namespace InetStudio\SocialContest\Posts\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use InetStudio\SocialContest\Posts\DTO\ItemData;
use InetStudio\Instagram\Stories\Pipelines\Filters\ByPK;
use InetStudio\Instagram\Stories\Pipelines\Filters\ByTags;
use InetStudio\Instagram\Stories\Pipelines\Filters\ByUserPK;
use InetStudio\Instagram\Stories\Pipelines\Filters\ByCreatedGt;
use InetStudio\Instagram\Stories\Pipelines\Filters\ByCreatedLt;
use InetStudio\Instagram\Users\Contracts\Services\Back\UsersServiceContract;
use InetStudio\Instagram\Stories\Contracts\Services\Back\StoriesServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchInstagramPostsByTagCommandContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

/**
 * Class SearchInstagramStoriesByTagCommand.
 */
class SearchInstagramStoriesByTagCommand extends Command implements SearchInstagramPostsByTagCommandContract
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $signature = 'inetstudio:social-contest:stories:instagram';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Search instagram stories by tag';

    /**
     * @var StoriesServiceContract
     */
    protected StoriesServiceContract $instagramStories;

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
     * @param  StoriesServiceContract  $instagramStories
     * @param  UsersServiceContract  $instagramUsers
     * @param  ItemsServiceContract  $itemsService
     * @param  StatusesServiceContract $statusesService
     */
    public function __construct(
        StoriesServiceContract $instagramStories,
        UsersServiceContract $instagramUsers,
        ItemsServiceContract $itemsService,
        StatusesServiceContract $statusesService
    ) {
        parent::__construct();

        $this->instagramStories = $instagramStories;
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
        $existPKs = $this->instagramStories->repository->getAllItems()->pluck('pk')->toArray();
        $startTime = null;//config('social_contest.start');
        $endTime = null;//config('social_contest.end');
        $tags = config('social_contest.tags');

        foreach ($tags as $tagArr) {
            $socialStories = $this->instagramStories->getStoriesByTag(
                $tagArr,
                [
                    'usersPKs' => new ByUserPK($blockedUsersPKs),
                    'PKs' => new ByPK($existPKs),
                    //'startTime' => new ByCreatedGt(($startTime) ? strtotime($startTime) : null),
                    //'endTime' => new ByCreatedLt(($endTime) ? strtotime($endTime) : null),
                    'tags' => new ByTags($tagArr),
                ]
            );

            foreach ($socialStories as $socialStory) {
                $this->instagramUsers->save($socialStory->getUser());
                $savedSocialStory = $this->instagramStories->save($socialStory);

                $searchData = $savedSocialStory->additional_info;
                Arr::forget(
                    $searchData,
                    [
                        'reel_mentions', 'image_versions2', 'video_versions',
                    ]
                );

                $defaultStatus = $this->statusesService->getItemsByType('default')->first();

                $data = new ItemData(
                    [
                        'uuid' => Str::uuid(),
                        'social_type' => get_class($savedSocialStory),
                        'social_id' => $savedSocialStory->id,
                        'status_id' => $defaultStatus->id ?? 1,
                        'search_data' => $searchData,
                    ]
                );

                $this->itemsService->save($data);
            }
        }
    }

    /**
     * Возвращаем PK заблокированных пользователей.
     *
     * @return array
     */
    protected function getBlockedUsers(): array
    {
        $blockStatuses = $this->statusesService->getModel()->where('alias', '=', 'blocked')->get();

        if ($blockStatuses->count() > 0) {
            $blockedPosts = $this->itemsService->getItemsByStatuses($blockStatuses);
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
