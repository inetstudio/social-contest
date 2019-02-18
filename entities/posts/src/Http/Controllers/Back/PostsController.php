<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\SavePostRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\FormResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\SaveResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\IndexResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\AddPostResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\DestroyResponseContract;

/**
 * Class PostsController.
 */
class PostsController extends Controller implements PostsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->services['posts'] = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(int $id = 0): FormResponseContract
    {
        $item = $this->services['posts']->getItemById($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SavePostRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SavePostRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SavePostRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SavePostRequestContract $request, int $id = 0): SaveResponseContract
    {
        $data = $request->only($this->services['posts']->repository->getModel()->getFillable());
        $item = $this->services['posts']->save($data, $id);

        return app()->makeWith(SaveResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['posts']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }

    /**
     * Ручное добавление поста.
     *
     * @param Request $request
     *
     * @return AddPostResponseContract
     */
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
}
