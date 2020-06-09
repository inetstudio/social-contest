<?php

namespace InetStudio\SocialContest\Posts\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByPK;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByTags;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByUserPK;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByCreatedGt;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByCreatedLt;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByMediaType;
use InetStudio\SocialContest\Posts\DTO\Back\Resource\Store\ItemData;
use InetStudio\Instagram\Posts\Contracts\Services\Back\PostsServiceContract;
use InetStudio\Instagram\Users\Contracts\Services\Back\UsersServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Console\Commands\SearchInstagramPostsByTagCommandContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

class SearchInstagramPostsByTagCommand extends Command implements SearchInstagramPostsByTagCommandContract
{
    protected $signature = 'inetstudio:social-contest:posts:instagram';

    protected $description = 'Search instagram posts by tag';

    protected PostsServiceContract $instagramPosts;

    protected UsersServiceContract $instagramUsers;

    protected ItemsServiceContract $itemsService;

    protected ResourceServiceContract $resourceService;

    protected StatusesServiceContract $statusesService;

    public function __construct(
        PostsServiceContract $instagramPosts,
        UsersServiceContract $instagramUsers,
        ItemsServiceContract $itemsService,
        ResourceServiceContract $resourceService,
        StatusesServiceContract $statusesService
    ) {
        parent::__construct();

        $this->instagramPosts = $instagramPosts;
        $this->instagramUsers = $instagramUsers;
        $this->itemsService = $itemsService;
        $this->resourceService = $resourceService;
        $this->statusesService = $statusesService;
    }

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
                $savedSocialPost = $this->instagramPosts->save($socialPost, $mediaTypes);

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
                    $mediaTypes = [1, 2];
                    break;
                case 'photo':
                    $mediaTypes = [1];
                    break;
                case 'video':
                    $mediaTypes = [2];
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
