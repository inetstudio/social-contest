<?php

Route::group([
    'namespace' => 'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/social-contest',
], function () {
    Route::any('statuses/data', 'StatusesDataControllerContract@data')->name('back.social-contest.statuses.data.index');
    Route::post('statuses/suggestions', 'StatusesUtilityControllerContract@getSuggestions')->name('back.social-contest.statuses.getSuggestions');

    Route::resource('statuses', 'StatusesControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.social-contest']);
});
