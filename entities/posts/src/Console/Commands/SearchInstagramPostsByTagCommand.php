<?php

namespace InetStudio\SocialContest\Posts\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByPK;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByTags;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByUserPK;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByCreatedGt;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByCreatedLt;
use InetStudio\Instagram\Posts\Pipelines\Filters\ByMediaType;

/**
 * Class SearchInstagramPostsByTagCommand.
 */
class SearchInstagramPostsByTagCommand extends Command
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
     * @var array
     */
    protected $services = [];

    /**
     * SearchInstagramPostsByTagCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->services['instagramPosts'] = app()->make('InetStudio\Instagram\Posts\Contracts\Services\Back\PostsServiceContract');
        $this->services['instagramUsers'] = app()->make('InetStudio\Instagram\Users\Contracts\Services\Back\UsersServiceContract');
        $this->services['contestPosts'] = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsServiceContract');
    }

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $blockedUsersPKs = $this->getBlockedUsers();
        $existPKs = $this->services['instagramPosts']->repository->getAllItems()->pluck('pk')->toArray();
        $mediaTypes = $this->getMediaTypes();
        $startTime = config('social_contest.start');
        $endTime = config('social_contest.end');
        $tags = config('social_contest.tags');

        foreach ($tags as $tagArr) {
            $instagramPosts = $this->services['instagramPosts']->getPostsByTag($tagArr, [
                'usersPKs' => new ByUserPK($blockedUsersPKs),
                'PKs' => new ByPK($existPKs),
                'mediaType' => new ByMediaType($mediaTypes),
                'startTime' => new ByCreatedGt(($startTime) ? strtotime($startTime) : null),
                'endTime' => new ByCreatedLt(($endTime) ? strtotime($endTime) : null),
                'tags' => new ByTags($tagArr),
            ]);

            foreach ($instagramPosts as $instagramPost) {
                $this->services['contestPosts']->createPostFromInstagram($instagramPost);
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
        $statusesService = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract');

        $blockStatus = $statusesService->getStatusByType('block');

        if ($blockStatus) {
            $blockedPosts = $this->services['contestPosts']->repository->getItemsQuery()->with('social')->where('status_id', $blockStatus->id)->get();
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
