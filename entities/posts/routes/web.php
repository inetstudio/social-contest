<?php

Route::group([
    'namespace' => 'InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/social-contest',
], function () {
    Route::any('posts/data', 'PostsDataControllerContract@data')->name('back.social-contest.posts.data.index');
    Route::post('posts/suggestions', 'PostsUtilityControllerContract@getSuggestions')->name('back.social-contest.posts.getSuggestions');
    Route::post('posts/moderate/{id}/{statusAlias}', 'PostsModerateControllerContract@moderate')->name('back.social-contest.posts.moderate');
    Route::post('posts/add', 'PostsControllerContract@addPost')->name('back.social-contest.posts.add');

    Route::resource('posts', 'PostsControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.social-contest']);
});
