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
            use Nusara\Pulse\Http\Controllers\Api\Attendance\AttendanceApiController;
            use Nusara\Pulse\Http\Controllers\Api\Overtime\OvertimeApiController;
            use Nusara\Pulse\Http\Controllers\Api\Leave\ReasonApiController;
            use Nusara\Pulse\Http\Controllers\Api\Leave\LeaveApiController;
            use Nusara\Pulse\Http\Controllers\Api\Payroll\SalaryComponentApiController;
            use Nusara\Pulse\Http\Controllers\Api\Payroll\SalaryBenefitApiController;
            use Nusara\Pulse\Http\Controllers\Api\Payroll\SalaryBenefitHistoryApiController;
            use Nusara\Pulse\Http\Controllers\Api\Payroll\SalaryAllowanceApiController;
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


            Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function () {
                Route::get('/', [AttendanceApiController::class, 'index'])->name('index');
                Route::get('/export', [AttendanceApiController::class, 'export'])->name('export');
                Route::get('/{id}', [AttendanceApiController::class, 'show'])->name('show');
                Route::post('/', [AttendanceApiController::class, 'store'])->name('store');
                Route::put('/{id}', [AttendanceApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [AttendanceApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'overtime', 'as' => 'overtime.'], function () {
                Route::get('/', [OvertimeApiController::class, 'index'])->name('index');
                Route::get('/export', [OvertimeApiController::class, 'export'])->name('export');
                Route::get('/{id}', [OvertimeApiController::class, 'show'])->name('show');
                Route::post('/', [OvertimeApiController::class, 'store'])->name('store');
                Route::put('/{id}', [OvertimeApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [OvertimeApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'reason', 'as' => 'reason.'], function () {
                Route::get('/', [ReasonApiController::class, 'index'])->name('index');
                Route::get('/export', [ReasonApiController::class, 'export'])->name('export');
                Route::get('/{id}', [ReasonApiController::class, 'show'])->name('show');
                Route::post('/', [ReasonApiController::class, 'store'])->name('store');
                Route::put('/{id}', [ReasonApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [ReasonApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'leave', 'as' => 'leave.'], function () {
                Route::get('/', [LeaveApiController::class, 'index'])->name('index');
                Route::get('/export', [LeaveApiController::class, 'export'])->name('export');
                Route::get('/{id}', [LeaveApiController::class, 'show'])->name('show');
                Route::post('/', [LeaveApiController::class, 'store'])->name('store');
                Route::put('/{id}', [LeaveApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [LeaveApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'salary-component', 'as' => 'salary-component.'], function () {
                Route::get('/', [SalaryComponentApiController::class, 'index'])->name('index');
                Route::get('/export', [SalaryComponentApiController::class, 'export'])->name('export');
                Route::get('/{id}', [SalaryComponentApiController::class, 'show'])->name('show');
                Route::post('/', [SalaryComponentApiController::class, 'store'])->name('store');
                Route::put('/{id}', [SalaryComponentApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [SalaryComponentApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'salary-benefit', 'as' => 'salary-benefit.'], function () {
                Route::get('/', [SalaryBenefitApiController::class, 'index'])->name('index');
                Route::get('/export', [SalaryBenefitApiController::class, 'export'])->name('export');
                Route::get('/{id}', [SalaryBenefitApiController::class, 'show'])->name('show');
                Route::post('/', [SalaryBenefitApiController::class, 'store'])->name('store');
                Route::put('/{id}', [SalaryBenefitApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [SalaryBenefitApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'salary-benefit-history', 'as' => 'salary-benefit-history.'], function () {
                Route::get('/', [SalaryBenefitHistoryApiController::class, 'index'])->name('index');
                Route::get('/export', [SalaryBenefitHistoryApiController::class, 'export'])->name('export');
                Route::get('/{id}', [SalaryBenefitHistoryApiController::class, 'show'])->name('show');
                Route::post('/', [SalaryBenefitHistoryApiController::class, 'store'])->name('store');
                Route::put('/{id}', [SalaryBenefitHistoryApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [SalaryBenefitHistoryApiController::class, 'delete'])->name('delete');
            });


            Route::group(['prefix' => 'salary-allowance', 'as' => 'salary-allowance.'], function () {
                Route::get('/', [SalaryAllowanceApiController::class, 'index'])->name('index');
                Route::get('/export', [SalaryAllowanceApiController::class, 'export'])->name('export');
                Route::get('/{id}', [SalaryAllowanceApiController::class, 'show'])->name('show');
                Route::post('/', [SalaryAllowanceApiController::class, 'store'])->name('store');
                Route::put('/{id}', [SalaryAllowanceApiController::class, 'update'])->name('update');
                Route::delete('/{id}', [SalaryAllowanceApiController::class, 'delete'])->name('delete');
            });

            //replaceRoute

























});
