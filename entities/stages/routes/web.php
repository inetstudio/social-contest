<?php

Route::group([
    'namespace' => 'InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/social-contest',
], function () {
    Route::any('stages/data', 'StagesDataControllerContract@data')->name('back.social-contest.stages.data.index');
    Route::post('stages/suggestions', 'StagesUtilityControllerContract@getSuggestions')->name('back.social-contest.stages.getSuggestions');

    Route::resource('stages', 'StagesControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.social-contest']);
});
