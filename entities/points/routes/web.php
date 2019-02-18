<?php

Route::group([
    'namespace' => 'InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/social-contest',
], function () {
    Route::any('social-contest/points/data', 'PointsDataControllerContract@data')->name('back.social-contest.points.data.index');
    Route::post('social-contest/points/suggestions', 'PointsUtilityControllerContract@getSuggestions')->name('back.social-contest.points.getSuggestions');

    Route::resource('points', 'PointsControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.social-contest']);
});
