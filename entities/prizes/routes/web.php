<?php

Route::group([
    'namespace' => 'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/social-contest',
], function () {
    Route::any('prizes/data', 'PrizesDataControllerContract@data')->name('back.social-contest.prizes.data.index');
    Route::post('prizes/suggestions', 'PrizesUtilityControllerContract@getSuggestions')->name('back.social-contest.prizes.getSuggestions');

    Route::resource('prizes', 'PrizesControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.social-contest']);
});
