<?php

namespace InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\ShowRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\IndexRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\StoreRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\UpdateRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\StoreResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\DestroyRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

interface ResourceControllerContract
{
    public function index(IndexRequestContract $request, IndexResponseContract $response): IndexResponseContract;

    public function store(StoreRequestContract $request, StoreResponseContract $response): StoreResponseContract;

    public function show(ShowRequestContract $request, ShowResponseContract $response): ShowResponseContract;

    public function update(UpdateRequestContract $request, UpdateResponseContract $response): UpdateResponseContract;

    public function destroy(DestroyRequestContract $request, DestroyResponseContract $response): DestroyResponseContract;
}
