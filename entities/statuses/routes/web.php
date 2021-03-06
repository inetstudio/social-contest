<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/social-contest',
    ],
    function () {
        Route::any('statuses/data', 'DataControllerContract@getIndexData')
            ->name('back.social-contest.statuses.data.index');

        Route::post('statuses/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.social-contest.statuses.utility.suggestions');

        Route::resource(
            'statuses',
            'ResourceControllerContract',
            [
                'as' => 'back.social-contest',
            ]
        );
    }
);
