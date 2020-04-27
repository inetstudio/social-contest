<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/social-contest',
    ],
    function () {
        Route::any('prizes/data', 'DataControllerContract@getIndexData')
            ->name('back.social-contest.prizes.data.index');

        Route::post('prizes/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.social-contest.prizes.utility.suggestions');

        Route::resource(
            'prizes',
            'ResourceControllerContract',
            [
                'as' => 'back.social-contest',
            ]
        );
    }
);
