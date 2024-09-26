<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Nusara\Pulse\Http\Controllers\Api\Master\EducationInstituteApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\EducationTitleApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\RegionApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\CityApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\SkillGroupApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\SkillApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\HolidayApiController;
use Nusara\Pulse\Http\Controllers\Api\Master\ContractApiController;
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


            Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
                Route::get('/', [CityApiController::class, 'index'])->name('index');
                Route::get('/export', [CityApiController::class, 'export'])->name('export');
                Route::get('/{id}', [CityApiController::class, 'show'])->name('show');
                Route::post('/', [CityApiController::class, 'store'])->name('store');
                Route::put('/{id}', [CityApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [CityApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'skill-group', 'as' => 'skill-group.'], function () {
                Route::get('/', [SkillGroupApiController::class, 'index'])->name('index');
                Route::get('/export', [SkillGroupApiController::class, 'export'])->name('export');
                Route::get('/{id}', [SkillGroupApiController::class, 'show'])->name('show');
                Route::post('/', [SkillGroupApiController::class, 'store'])->name('store');
                Route::put('/{id}', [SkillGroupApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [SkillGroupApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'skill', 'as' => 'skill.'], function () {
                Route::get('/', [SkillApiController::class, 'index'])->name('index');
                Route::get('/export', [SkillApiController::class, 'export'])->name('export');
                Route::get('/{id}', [SkillApiController::class, 'show'])->name('show');
                Route::post('/', [SkillApiController::class, 'store'])->name('store');
                Route::put('/{id}', [SkillApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [SkillApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'holiday', 'as' => 'holiday.'], function () {
                Route::get('/', [HolidayApiController::class, 'index'])->name('index');
                Route::get('/export', [HolidayApiController::class, 'export'])->name('export');
                Route::get('/{id}', [HolidayApiController::class, 'show'])->name('show');
                Route::post('/', [HolidayApiController::class, 'store'])->name('store');
                Route::put('/{id}', [HolidayApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [HolidayApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'contract', 'as' => 'contract.'], function () {
                Route::get('/', [ContractApiController::class, 'index'])->name('index');
                Route::get('/export', [ContractApiController::class, 'export'])->name('export');
                Route::get('/{id}', [ContractApiController::class, 'show'])->name('show');
                Route::post('/', [ContractApiController::class, 'store'])->name('store');
                Route::put('/{id}', [ContractApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [ContractApiController::class, 'delete'])->name('delete');
            });

            //replaceRoute









});
