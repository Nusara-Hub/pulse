<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Nusara\Pulse\Http\Controllers\Api\EducationInstituteApiController;
use Nusara\Pulse\Http\Controllers\Api\EducationTitleApiController;
            use Nusara\Pulse\Http\Controllers\Api\RegionApiController;
            //useRoutes





Route::group(['prefix' => 'pulse', 'as' => 'pulse.'], function () {
    Route::group(['prefix' => 'education-institute', 'as' => 'institute.'], function () {
        Route::get('/', [EducationInstituteApiController::class, 'index'])->name('index');
        Route::get('/export', [EducationInstituteApiController::class, 'export'])->name('export');
        Route::get('/{id}', [EducationInstituteApiController::class, 'show'])->name('show');
        Route::post('/', [EducationInstituteApiController::class, 'store'])->name('store');
        Route::put('/{id}', [EducationInstituteApiController::class, 'update'])->name('update');
        Route::delete('/{id}', [EducationInstituteApiController::class, 'delete'])->name('delete');
    });


            Route::group(['prefix' => 'education-title', 'as' => 'education-title.'], function () {
                Route::get('/', [EducationTitleApiController::class, 'index'])->name('index');
                Route::get('/export', [EducationTitleApiController::class, 'export'])->name('export');
                Route::get('/{id}', [EducationTitleApiController::class, 'show'])->name('show');
                Route::post('/', [EducationTitleApiController::class, 'store'])->name('store');
                Route::put('/{id}', [EducationTitleApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [EducationTitleApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'region', 'as' => 'region.'], function () {
                Route::get('/', [RegionApiController::class, 'index'])->name('index');
                Route::get('/export', [RegionApiController::class, 'export'])->name('export');
                Route::get('/{id}', [RegionApiController::class, 'show'])->name('show');
                Route::post('/', [RegionApiController::class, 'store'])->name('store');
                Route::put('/{id}', [RegionApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [RegionApiController::class, 'delete'])->name('delete');
            });

            //replaceRoute




});
