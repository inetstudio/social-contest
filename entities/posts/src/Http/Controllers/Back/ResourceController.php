<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\ShowRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ResourceControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\IndexRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\StoreRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\UpdateRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\StoreResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\DestroyRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

class ResourceController extends Controller implements ResourceControllerContract
{
    public function index(IndexRequestContract $request, IndexResponseContract $response): IndexResponseContract
    {
        return $response;
    }

    public function store(StoreRequestContract $request, StoreResponseContract $response): StoreResponseContract
    {
        return $response;
    }

    public function show(ShowRequestContract $request, ShowResponseContract $response): ShowResponseContract
    {
        return $response;
    }

    public function update(UpdateRequestContract $request, UpdateResponseContract $response): UpdateResponseContract
    {
        return $response;
    }

    public function destroy(DestroyRequestContract $request, DestroyResponseContract $response): DestroyResponseContract
    {
        return $response;
    }

    /**
     * Ручное добавление поста.
     *
     * @param //Request $request
     *
     * @return //AddPostResponseContract
     */
    /*
    public function addPost(Request $request): AddPostResponseContract
    {
        $network = $request->get('social_network');
        $link = $request->get('social_post_link');

        switch ($network) {
            case 'instagram':
                $instagramPostsService = app()->make('InetStudio\Instagram\Posts\Contracts\Services\Back\PostsServiceContract');

                $parsedUrl = explode('/', trim(parse_url($link, PHP_URL_PATH), '/'));
                $code = end($parsedUrl);

                $instagramPost = $instagramPostsService->getPostByCode($code);
                $contestPost = $this->services['posts']->createPostFromInstagram($instagramPost);

                break;
            case 'vkontakte':
                $vkontaktePostsService = app()->make('InetStudio\Vkontakte\Posts\Contracts\Services\Back\PostsServiceContract');
                $vkontakteUsersService = app()->make('InetStudio\Vkontakte\Users\Contracts\Services\Back\UsersServiceContract');

                $id = str_replace('w=wall', '', parse_url($link, PHP_URL_QUERY));

                $vkontaktePost = $vkontaktePostsService->getPostByID($id);
                $vkontaktePost = $vkontakteUsersService->attachUsersToPosts($vkontaktePost);

                $contestPost = $this->services['posts']->createPostFromVkontakte($vkontaktePost[0]);

                break;
        }

        return app()->makeWith(AddPostResponseContract::class, [
            'result' => (isset($contestPost) && $contestPost->id),
        ]);
    }
    */
}
