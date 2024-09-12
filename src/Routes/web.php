<?php

declare(strict_types=1);

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Nusara\Pulse\Http\Controllers\EducationInstituteController;

Route::group(['prefix' => 'pulse', 'as' => 'pulse.'], function () {
    // ...
    Route::get('/', function () {
        return Inertia::render('pulse::Welcome', [
            'user' => ['name' => 'Jonathan Liandi']
        ]);
    });
    Route::group(['prefix' => 'education-institute', 'as' => 'institute.'], function () {
        Route::get('/', [EducationInstituteController::class, 'index'])->name('index');
        Route::get('/create', [EducationInstituteController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [EducationInstituteController::class, 'edit'])->name('edit');
    });
});
