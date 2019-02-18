<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Posts;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\AddPostResponseContract;

/**
 * Class AddPostResponse.
 */
class AddPostResponse implements AddPostResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * AddPostResponse constructor.
     *
     * @param bool $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при удалении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'success' => $this->result,
        ]);
    }
}
