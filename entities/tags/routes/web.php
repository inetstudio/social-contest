<?php

Route::group([
    'namespace' => 'InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/social-contest',
], function () {
    Route::any('tags/data', 'TagsDataControllerContract@data')->name('back.social-contest.tags.data.index');
    Route::post('tags/suggestions', 'TagsUtilityControllerContract@getSuggestions')->name('back.social-contest.tags.getSuggestions');

    Route::resource('tags', 'TagsControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.social-contest']);
});
