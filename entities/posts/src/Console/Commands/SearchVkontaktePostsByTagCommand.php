<?php

namespace InetStudio\SocialContest\Posts\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByTags;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByPostId;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByUserId;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByCreatedGt;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByCreatedLt;
use InetStudio\Vkontakte\Posts\Pipelines\Filters\ByMediaType;

/**
 * Class SearchVkontaktePostsByTagCommand.
 */
class SearchVkontaktePostsByTagCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $signature = 'inetstudio:social-contest:posts:vkontakte';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Search vkontakte posts by tag';

    /**
     * @var array
     */
    protected $services = [];

    /**
     * SearchVkontaktePostsByTagCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->services['vkontaktePosts'] = app()->make('InetStudio\Vkontakte\Posts\Contracts\Services\Back\PostsServiceContract');
        $this->services['vkontakteUsers'] = app()->make('InetStudio\Vkontakte\Users\Contracts\Services\Back\UsersServiceContract');
        $this->services['contestPosts'] = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsServiceContract');
    }

    /**
     * Запуск команды.
     */
    public function handle(): void
    {
        $blockedUsersIDs = $this->getBlockedUsers();
        $existIDs = $this->services['vkontaktePosts']->repository->getAllItems()->pluck('post_id')->toArray();
        $mediaTypes = $this->getMediaTypes();
        $startTime = config('social_contest.start');
        $endTime = config('social_contest.end');
        $tags = config('social_contest.tags');

        foreach ($tags as $tagArr) {
            $vkontaktePosts = $this->services['vkontaktePosts']->getPostsByTag($tagArr, [
                'usersIDs' => new ByUserId($blockedUsersIDs),
                'IDs' => new ByPostId($existIDs),
                'mediaType' => new ByMediaType($mediaTypes),
                'startTime' => new ByCreatedGt(($startTime) ? strtotime($startTime) : null),
                'endTime' => new ByCreatedLt(($endTime) ? strtotime($endTime) : null),
                'tags' => new ByTags($tagArr),
            ]);

            $vkontaktePosts = $this->services['vkontakteUsers']->attachUsersToPosts($vkontaktePosts);

            foreach ($vkontaktePosts as $vkontaktePost) {
                $this->services['contestPosts']->createPostFromVkontakte($vkontaktePost);
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
                    $mediaTypes = ['video', 'photo', 'link'];
                    break;
                default:
                    $mediaTypes[] = $configType;
                    break;
            }
        }

        return $mediaTypes;
    }

    /**
     * Возвращаем Id заблокированных пользователей.
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
