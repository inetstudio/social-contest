<?php

namespace InetStudio\SocialContest\Posts\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByTags;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByPostId;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByUserId;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByCreatedGt;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByCreatedLt;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByMediaType;
use InetStudio\SocialContest\Posts\DTO\Back\Resource\Store\ItemData;
use InetStudio\Vkontakte\Posts\Contracts\Services\Back\PostsServiceContract;
use InetStudio\Vkontakte\Users\Contracts\Services\Back\UsersServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchVkontaktePostsByTagCommandContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

class SearchVkontaktePostsByTagCommand extends Command implements SearchVkontaktePostsByTagCommandContract
{
    protected $signature = 'inetstudio:social-contest:posts:vkontakte';

    protected $description = 'Search vkontakte posts by tag';

    protected PostsServiceContract $vkontaktePosts;

    protected UsersServiceContract $vkontakteUsers;

    protected ItemsServiceContract $itemsService;

    protected ResourceServiceContract $resourceService;

    protected StatusesServiceContract $statusesService;

    public function __construct(
        PostsServiceContract $vkontaktePosts,
        UsersServiceContract $vkontakteUsers,
        ItemsServiceContract $itemsService,
        ResourceServiceContract $resourceService,
        StatusesServiceContract $statusesService
    ) {
        parent::__construct();

        $this->vkontaktePosts = $vkontaktePosts;
        $this->vkontakteUsers = $vkontakteUsers;
        $this->itemsService = $itemsService;
        $this->resourceService = $resourceService;
        $this->statusesService = $statusesService;
    }

    public function handle(): void
    {
        $blockedUsersIDs = $this->getBlockedUsers();
        $existIDs = $this->vkontaktePosts->repository->getAllItems()->pluck('post_id')->toArray();
        $mediaTypes = $this->getMediaTypes();
        $startTime = config('social_contest.start');
        $endTime = config('social_contest.end');
        $tags = config('social_contest.tags');

        foreach ($tags as $tagArr) {
            $socialPosts = $this->vkontaktePosts->getPostsByTag(
                $tagArr,
                [
                    'usersIDs' => new ByUserId($blockedUsersIDs),
                    'IDs' => new ByPostId($existIDs),
                    'mediaType' => new ByMediaType($mediaTypes),
                    'startTime' => new ByCreatedGt(($startTime) ? strtotime($startTime) : null),
                    'endTime' => new ByCreatedLt(($endTime) ? strtotime($endTime) : null),
                    'tags' => new ByTags($tagArr),
                ]
            );

            $socialPosts = $this->vkontakteUsers->attachUsersToPosts($socialPosts);

            foreach ($socialPosts as $socialPost) {
                $this->vkontakteUsers->save($socialPost['user']);
                $savedSocialPost = $this->vkontaktePosts->save($socialPost);

                $searchData = $savedSocialPost->additional_info;
                Arr::forget(
                    $searchData,
                    [
                        'attachments', 'likes', 'reposts', 'views',
                        'post_source', 'comments',
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

                $this->resourceService->store($data);
            }
        }
    }

    protected function getMediaTypes(): array
    {
        $configTypes = config('social_contest.types');
        $mediaTypes = [];

        foreach ($configTypes ?? [] as $configType) {
            switch ($configType) {
                case 'all':
                    $mediaTypes = ['video', 'photo', 'link'];
                    break;
                default:
                    $mediaTypes[] = $configType;
                    break;
            }
        }

        return $mediaTypes;
    }

    protected function getBlockedUsers(): array
    {
        $blockStatuses = $this->statusesService->getModel()->where('alias', '=', 'blocked')->get();

        if ($blockStatuses->count() > 0) {
            $blockedPosts = $this->itemsService->getItemsByStatuses($blockStatuses);
            $userIds = [];

            foreach ($blockedPosts as $blockedPost) {
                if ($blockedPost->social->social_name !== 'vkontakte') {
                    continue;
                }

                $userIds[] = $blockedPost->social->user->user_id;
            }

            return array_unique($userIds);
        }

        return [];
    }
}
