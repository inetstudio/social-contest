<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/social-contest',
    ],
    function () {
        Route::any('posts/data', 'DataControllerContract@getIndexData')
            ->name('back.social-contest.posts.data.index');

        Route::post('posts/moderate/{id}/{alias}', 'ModerateControllerContract@moderate')
            ->name('back.social-contest.posts.moderate');

        Route::post('posts/add', 'PostsControllerContract@addPost')->name('back.social-contest.posts.add');

        Route::get('posts/export', 'ExportControllerContract@exportItems')
            ->name('back.social-contest.posts.export');

        Route::resource(
            'posts',
            'ResourceControllerContract',
            [
                'except' => [
                    'show',
                ],
             'as' => 'back.social-contest'
            ]
        );
    }
);
