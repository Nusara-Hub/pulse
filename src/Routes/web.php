<?php

declare(strict_types=1);

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Nusara\Pulse\Http\Controllers\Master\EducationInstituteController;
use Nusara\Pulse\Http\Controllers\Master\EducationTitleController;
use Nusara\Pulse\Http\Controllers\Master\RegionController;
use Nusara\Pulse\Http\Controllers\Master\CityController;
            use Nusara\Pulse\Http\Controllers\Master\SkillGroupController;
            use Nusara\Pulse\Http\Controllers\Master\SkillController;
            use Nusara\Pulse\Http\Controllers\Master\HolidayController;
            //useController
        
        
        
        



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

            Route::group(['prefix' => 'education-title', 'as' => 'education-title.'], function () {
                Route::get('/', [EducationTitleController::class, 'index'])->name('index');
                Route::get('/create', [EducationTitleController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [EducationTitleController::class, 'edit'])->name('edit');
            });
            Route::group(['prefix' => 'region', 'as' => 'region.'], function () {
                Route::get('/', [RegionController::class, 'index'])->name('index');
                Route::get('/create', [RegionController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [RegionController::class, 'edit'])->name('edit');
            });
            
            Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
                Route::get('/', [CityController::class, 'index'])->name('index');
                Route::get('/create', [CityController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [CityController::class, 'edit'])->name('edit');
            });
            
            Route::group(['prefix' => 'skill-group', 'as' => 'skill-group.'], function () {
                Route::get('/', [SkillGroupController::class, 'index'])->name('index');
                Route::get('/create', [SkillGroupController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [SkillGroupController::class, 'edit'])->name('edit');
            });
            
            Route::group(['prefix' => 'skill', 'as' => 'skill.'], function () {
                Route::get('/', [SkillController::class, 'index'])->name('index');
                Route::get('/create', [SkillController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [SkillController::class, 'edit'])->name('edit');
            });
            
            Route::group(['prefix' => 'holiday', 'as' => 'holiday.'], function () {
                Route::get('/', [HolidayController::class, 'index'])->name('index');
                Route::get('/create', [HolidayController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [HolidayController::class, 'edit'])->name('edit');
            });
            //replaceRoute
        
        
        
        


});
