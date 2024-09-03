<?php

declare(strict_types=1);

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pulse', 'as' => 'pulse.'], function () {
    // ...
    Route::get('/packages', function () {
        return Inertia::render('pulse::Welcome', [
            'user' => ['name' => 'Jonathan Liandi']
        ]);
    });
});
