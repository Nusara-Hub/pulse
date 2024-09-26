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
use Nusara\Pulse\Http\Controllers\Api\Companies\DepartmentApiController;
use Nusara\Pulse\Http\Controllers\Api\Companies\JobLevelApiController;
            use Nusara\Pulse\Http\Controllers\Api\Companies\JobTitleApiController;
            use Nusara\Pulse\Http\Controllers\Api\Employee\EmployeeApiController;
            use Nusara\Pulse\Http\Controllers\Api\Employee\PlacementApiController;
            use Nusara\Pulse\Http\Controllers\Api\Employee\MutationApiController;
            use Nusara\Pulse\Http\Controllers\Api\Attendance\AbsentReasonApiController;
            use Nusara\Pulse\Http\Controllers\Api\Attendance\ShiftmentApiController;
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


            Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
                Route::get('/', [DepartmentApiController::class, 'index'])->name('index');
                Route::get('/export', [DepartmentApiController::class, 'export'])->name('export');
                Route::get('/{id}', [DepartmentApiController::class, 'show'])->name('show');
                Route::post('/', [DepartmentApiController::class, 'store'])->name('store');
                Route::put('/{id}', [DepartmentApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [DepartmentApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'job-level', 'as' => 'job-level.'], function () {
                Route::get('/', [JobLevelApiController::class, 'index'])->name('index');
                Route::get('/export', [JobLevelApiController::class, 'export'])->name('export');
                Route::get('/{id}', [JobLevelApiController::class, 'show'])->name('show');
                Route::post('/', [JobLevelApiController::class, 'store'])->name('store');
                Route::put('/{id}', [JobLevelApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [JobLevelApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'job-title', 'as' => 'job-title.'], function () {
                Route::get('/', [JobTitleApiController::class, 'index'])->name('index');
                Route::get('/export', [JobTitleApiController::class, 'export'])->name('export');
                Route::get('/{id}', [JobTitleApiController::class, 'show'])->name('show');
                Route::post('/', [JobTitleApiController::class, 'store'])->name('store');
                Route::put('/{id}', [JobTitleApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [JobTitleApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'employee', 'as' => 'employee.'], function () {
                Route::get('/', [EmployeeApiController::class, 'index'])->name('index');
                Route::get('/export', [EmployeeApiController::class, 'export'])->name('export');
                Route::get('/{id}', [EmployeeApiController::class, 'show'])->name('show');
                Route::post('/', [EmployeeApiController::class, 'store'])->name('store');
                Route::put('/{id}', [EmployeeApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [EmployeeApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'placement', 'as' => 'placement.'], function () {
                Route::get('/', [PlacementApiController::class, 'index'])->name('index');
                Route::get('/export', [PlacementApiController::class, 'export'])->name('export');
                Route::get('/{id}', [PlacementApiController::class, 'show'])->name('show');
                Route::post('/', [PlacementApiController::class, 'store'])->name('store');
                Route::put('/{id}', [PlacementApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [PlacementApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'mutation', 'as' => 'mutation.'], function () {
                Route::get('/', [MutationApiController::class, 'index'])->name('index');
                Route::get('/export', [MutationApiController::class, 'export'])->name('export');
                Route::get('/{id}', [MutationApiController::class, 'show'])->name('show');
                Route::post('/', [MutationApiController::class, 'store'])->name('store');
                Route::put('/{id}', [MutationApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [MutationApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'absent-reason', 'as' => 'absent-reason.'], function () {
                Route::get('/', [AbsentReasonApiController::class, 'index'])->name('index');
                Route::get('/export', [AbsentReasonApiController::class, 'export'])->name('export');
                Route::get('/{id}', [AbsentReasonApiController::class, 'show'])->name('show');
                Route::post('/', [AbsentReasonApiController::class, 'store'])->name('store');
                Route::put('/{id}', [AbsentReasonApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [AbsentReasonApiController::class, 'delete'])->name('delete');
            });

            
            Route::group(['prefix' => 'shiftment', 'as' => 'shiftment.'], function () {
                Route::get('/', [ShiftmentApiController::class, 'index'])->name('index');
                Route::get('/export', [ShiftmentApiController::class, 'export'])->name('export');
                Route::get('/{id}', [ShiftmentApiController::class, 'show'])->name('show');
                Route::post('/', [ShiftmentApiController::class, 'store'])->name('store');
                Route::put('/{id}', [ShiftmentApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [ShiftmentApiController::class, 'delete'])->name('delete');
            });

            //replaceRoute
        
        
        
        
        
        
        










});
