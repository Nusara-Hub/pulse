<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Pulse.Education Institutes Table
        Schema::create('pulse.education_institutes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Education Institutes Table

        // Pulse.Education Titles Table
        Schema::create('pulse.education_titles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('short_name')->nullable();
            $table->string('name')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Education Titles Table

        // Pulse.Skill Groups Table
        Schema::create('pulse.skill_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });

        Schema::table('pulse.skill_groups', function (Blueprint $table) {
            $table->foreignUuid('parent_id')
                ->nullable()
                ->references('id')
                ->on('pulse.skill_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // End Pulse.Skill Groups Table

        // Pulse.Skills Table
        Schema::create('pulse.skills', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('skill_group_id')
                ->references('id')
                ->on('pulse.skill_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('name')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Skills Table

        // Pulse.Regions Table
        Schema::create('pulse.regions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable();
            $table->string('name')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Regions Table

        // Pulse.Cities Table
        Schema::create('pulse.cities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable();
            $table->string('name')->nullable();

            $table->foreignUuid('region_id')
                ->references('id')
                ->on('pulse.regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Cities Table

        // Pulse.Absent Reasons Table
        Schema::create('pulse.absent_reasons', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns Here
            $table->string('type')->default('absent');
            $table->string('code')->nullable();
            $table->text('reason');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Absent Reasons Table

        // Pulse.Contracts Table
        Schema::create('pulse.contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('type');
            $table->string('letter_number', 100);
            $table->string('subject')->nullable();
            $table->string('tags')->nullable();

            $table->text('description')->nullable();

            $table->date('start_date');
            $table->date('end_date');
            $table->date('signed_date');

            $table->boolean('used')->default(false);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Contracts Table

        // Pulse.Holidays Table
        Schema::create('pulse.holidays', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('name');

            $table->date('holiday_date');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Holidays Table

        // Pulse.Job Levels Table
        Schema::create('pulse.job_levels', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('name');
            $table->string('code');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });

        Schema::table('pulse.job_levels', function (Blueprint $table) {
            $table->foreignUuid('parent_id')
                ->nullable()
                ->references('id')
                ->on('pulse.job_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // End Pulse.Job Levels Table

        // Pulse.Job Titles Table
        Schema::create('pulse.job_titles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('job_level_id')
                ->references('id')
                ->on('pulse.job_levels')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('code');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Job Titles Table

        // Pulse.Departments Table
        Schema::create('pulse.departments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('name');
            $table->string('code');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });

        Schema::table('pulse.departments', function (Blueprint $table) {
            $table->foreignUuid('parent_id')
                ->references('id')
                ->on('pulse.departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // End Pulse.Departments Table

        // Pulse.Employees Table
        Schema::create('pulse.employees', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreignUuid('contract_id')
                ->references('id')
                ->on('pulse.contracts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('department_id')
                ->references('id')
                ->on('pulse.departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('job_level_id')
                ->references('id')
                ->on('pulse.job_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('job_title_id')
                ->references('id')
                ->on('pulse.job_titles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('supervisor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('fullname');
            $table->string('code');
            $table->string('gender', 20);
            $table->string('place_of_birth');
            $table->string('identity_type', 100);
            $table->string('identity_number', 100);
            $table->string('martial_status');
            $table->string('email');
            $table->string('employee_status');

            $table->text('profile_image')->nullable();

            $table->enum('risk_ratio', ['verylow', 'low', 'normal', 'high', 'veryhigh']);

            $table->date('date_of_birth');
            $table->date('resign_date')->nullable();
            $table->date('join_date');

            $table->unsignedInteger('leave_balance')->default(12);

            $table->boolean('have_overtime_benefit')->default(false);

            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Employees Table

        // Pulse.Reasons Table
        Schema::create('pulse.reasons', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Reasons Table

        // Pulse.Shiftments Table
        Schema::create('pulse.shiftments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('name');
            $table->string('code')->nullable();

            $table->time('start_hour')->nullable();
            $table->time('end_hour')->nullable();
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Shiftments Tables

        // Pulse.Attendances Table
        Schema::create('pulse.attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('reason_id')
                ->references('id')
                ->on('pulse.reasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('shiftment_id')
                ->references('id')
                ->on('pulse.shiftments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('attendance_date');

            $table->text('description')->nullable();

            $table->time('check_in');
            $table->time('check_out');

            $table->unsignedInteger('early_in')->default(0);
            $table->unsignedInteger('early_out')->default(0);
            $table->unsignedInteger('late_in')->default(0);
            $table->unsignedInteger('late_out')->default(0);

            $table->boolean('is_absent')->default(false);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Attendances Tables

        // Pulse.Atendance Summaries Table
        Schema::create('pulse.attendance_summaries', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->year('year');

            $table->unsignedInteger('month');
            $table->unsignedInteger('total_in')->default(0);
            $table->unsignedInteger('total_loyality')->default(0);
            $table->unsignedInteger('total_absent')->default(0);
            $table->unsignedInteger('total_overtime')->default(0);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Atendance Summaries Tables

        // Pulse.Career Histories Table
        Schema::create('pulse.career_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('contract_id')
                ->references('id')
                ->on('pulse.contracts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('department_id')
                ->references('id')
                ->on('pulse.departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('job_level_id')
                ->references('id')
                ->on('pulse.job_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('job_title_id')
                ->references('id')
                ->on('pulse.job_titles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('supervisor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('description')->nullable();
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Career Histories Table

        // Company Address Table
        Schema::create('company_address', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('region_id')
                ->references('id')
                ->on('pulse.regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('city_id')
                ->references('id')
                ->on('pulse.cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('address')->nullable();

            $table->string('postal_code', 30)->nullable();
            $table->string('phone_number', 30);
            $table->string('fax_number', 30)->nullable();

            $table->boolean('is_default_address')->default(false);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Company Address Table

        // Pulse.Payroll Periods Table
        Schema::create('pulse.payroll_periods', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->year('year');

            $table->unsignedInteger('month');

            $table->date('closed_date');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Payroll Periods Table

        // Pulse.Payrolls Table
        Schema::create('pulse.payrolls', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('period_id')
                ->references('id')
                ->on('pulse.payroll_periods')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->double('takehome_pay')->default(0);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Payrolls Table

        // Pulse.Sallary Components Table
        Schema::create('pulse.sallary_components', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('state')->nullable();;

            $table->boolean('is_fixed')->default(false);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Sallary Components Table

        // Pulse.Company Costs Table
        Schema::create('pulse.company_costs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('payroll_id')
                ->references('id')
                ->on('pulse.payrolls')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('sallary_component_id')
                ->references('id')
                ->on('pulse.sallary_components')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('benefit_value');

            $table->string('benefit_key');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Company Costs Table

        // Pulse.Company Payroll Costs Table
        Schema::create('pulse.company_payroll_costs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->string('payroll');
            $table->string('component');
            $table->string('benefit_value');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Company Payroll Costs Table

        // Pulse.Leave Table
        Schema::create('pulse.leave', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('reason_id')
                ->references('id')
                ->on('pulse.reasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('leave_date');

            $table->text('description')->nullable();

            $table->double('amount')->default(0);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Leave Table

        // Pulse.Mutations Table
        Schema::create('pulse.mutations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('old_company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('old_department_id')
                ->references('id')
                ->on('pulse.departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('old_job_level_id')
                ->references('id')
                ->on('pulse.job_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('old_job_title_id')
                ->references('id')
                ->on('pulse.job_titles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('old_supervisor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('new_company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('new_department_id')
                ->references('id')
                ->on('pulse.departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('new_job_level_id')
                ->references('id')
                ->on('pulse.job_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('new_job_title_id')
                ->references('id')
                ->on('pulse.job_titles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('new_supervisor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('contract_id')
                ->references('id')
                ->on('pulse.contracts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('type');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Mutations Table

        // Pulse.Overtime Table
        Schema::create('pulse.overtimes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('approved_by')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreignUuid('shiftment_id')
                ->references('id')
                ->on('pulse.shiftments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('overtime_date');

            $table->time('start_hour');
            $table->time('end_hour');

            $table->float('raw_value')->nullable();
            $table->float('calculated_value')->nullable();

            $table->boolean('is_holiday')->default(false);
            $table->boolean('is_overday')->default(false);

            $table->text('description')->nullable();
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Overtimes Table

        // Pulse.Payroll Details Table
        Schema::create('pulse.payroll_details', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('payroll_id')
                ->references('id')
                ->on('pulse.payrolls')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('sallary_component_id')
                ->references('id')
                ->on('pulse.sallary_components')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('benefit_value');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Payroll Details Table

        // Pulse.Placements Table
        Schema::create('pulse.placements', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('supervisor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('department_id')
                ->references('id')
                ->on('pulse.departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('job_level_id')
                ->references('id')
                ->on('pulse.job_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('job_title_id')
                ->references('id')
                ->on('pulse.job_titles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('contract_id')
                ->references('id')
                ->on('pulse.contracts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('is_active')->default(true);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Placements Table

        // Pulse.Sallary Allowances Table
        Schema::create('pulse.sallary_allowances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('sallary_component_id')
                ->references('id')
                ->on('pulse.sallary_components')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->year('year');

            $table->unsignedInteger('month');

            $table->text('benefit_value');

            $table->string('benefit_key');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Sallary Allowances Table

        // Pulse.Sallary Benefit Histories Table
        Schema::create('pulse.sallary_benefit_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('contract_id')
                ->references('id')
                ->on('pulse.contracts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('sallary_component_id')
                ->references('id')
                ->on('pulse.sallary_components')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('new_benefit_value')->nullable();
            $table->text('old_benefit_value')->nullable();
            $table->text('description')->nullable();

            $table->string('benefit_key');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Sallary Benefit Histories Table

        // Pulse.Sallary Benefits Table
        Schema::create('pulse.sallary_benefits', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('sallary_component_id')
                ->references('id')
                ->on('pulse.sallary_components')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('benefit_value')->nullable();

            $table->string('benefit_key');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Sallary Benefits Table

        // Pulse.Tax Group Histories Table
        Schema::create('pulse.tax_group_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('old_tax_group')->nullable();
            $table->string('new_tax_group')->nullable();
            $table->string('old_risk_ratio')->nullable();
            $table->string('new_risk_ratio')->nullable();
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Tax Group Histories Table

        // Pulse.Taxes Table
        Schema::create('pulse.taxes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('payroll_periode_id')
                ->references('id')
                ->on('pulse.payroll_periods')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('tax_group')->nullable();

            $table->text('untaxable')->nullable();
            $table->text('taxable')->nullable();
            $table->text('tax_value')->nullable();

            $table->string('tax_key')->nullable();
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Tax Group Histories Table

        // Pulse.Workshifts Table
        Schema::create('pulse.workshifts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('shiftment_id')
                ->references('id')
                ->on('pulse.shiftments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('description')->nullable();

            $table->date('start_date');
            $table->date('end_date');
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Workshifts Table

        // Pulse.Employee Address Table
        Schema::create('pulse.employee_address', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Columns here
            $table->foreignUuid('employee_id')
                ->references('id')
                ->on('pulse.employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('region_id')
                ->references('id')
                ->on('pulse.regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('city_id')
                ->references('id')
                ->on('pulse.cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('address');
            $table->string('postal_code', 50);
            $table->string('phone_number', 20);
            $table->string('fax_number', 50);

            $table->boolean('is_default')->default(false);
            // End of columns

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->unsignedBigInteger('created_at')->nullable();
            $table->unsignedBigInteger('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_at')->nullable();
        });
        // End Pulse.Employee Address Table
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Pulse.Education Institutes Table
        Schema::dropIfExists('pulse.education_institutes');

        // Pulse.Education Titles Table
        Schema::dropIfExists('pulse.education_titles');

        // Pulse.Skill Groups Table
        Schema::dropIfExists('pulse.skill_groups');

        // Pulse.Skills Table
        Schema::dropIfExists('pulse.skills');

        // Pulse.Regions Table
        Schema::dropIfExists('pulse.regions');

        // Pulse.Cities Table
        Schema::dropIfExists('pulse.cities');

        // Pulse.Absent Reasons Table
        Schema::dropIfExists('pulse.absent_reasons');

        // Pulse.Contracts Table
        Schema::dropIfExists('pulse.contracts');

        // Pulse.Holidays Table
        Schema::dropIfExists('pulse.holidays');

        // Pulse.Job Levels Table
        Schema::dropIfExists('pulse.job_levels');

        // Pulse.Job Titles Table
        Schema::dropIfExists('pulse.job_titles');

        // Pulse.Departments Table
        Schema::dropIfExists('pulse.departments');

        // Pulse.Employees Table
        Schema::dropIfExists('pulse.employees');

        // Pulse.Reasons Table
        Schema::dropIfExists('pulse.reasons');

        // Pulse.Shiftments Table
        Schema::dropIfExists('pulse.shiftments');

        // Pulse.Attendances Table
        Schema::dropIfExists('pulse.attendances');

        // Pulse.Attendances Summaries Table
        Schema::dropIfExists('pulse.attendance_summaries');

        // Pulse.Career Histories Table
        Schema::dropIfExists('pulse.career_histories');

        // Pulse.Company Address Table
        Schema::dropIfExists('company_address');

        // Pulse.Payroll Periods Table
        Schema::dropIfExists('pulse.payroll_periods');

        // Pulse.Payrolls Table
        Schema::dropIfExists('pulse.payrolls');

        // Pulse.Sallary Components Table
        Schema::dropIfExists('pulse.sallary_components');

        // Pulse.Company Costs Table
        Schema::dropIfExists('pulse.company_costs');

        // Pulse.Company Payroll Costs Table
        Schema::dropIfExists('pulse.company_payroll_costs');

        // Pulse.Leave Table
        Schema::dropIfExists('pulse.leave');

        // Pulse.Mutations Table
        Schema::dropIfExists('pulse.mutations');

        // Pulse.Overtimes Table
        Schema::dropIfExists('pulse.overtimes');

        // Pulse.Payroll Details Table
        Schema::dropIfExists('pulse.payroll_details');

        // Pulse.Placements Table
        Schema::dropIfExists('pulse.placements');

        // Pulse.Sallary Allowances Table
        Schema::dropIfExists('pulse.sallary_allowances');

        // Pulse.Sallary Benefit Histories Table
        Schema::dropIfExists('pulse.sallary_benefit_histories');

        // Pulse.Sallary Benefits Table
        Schema::dropIfExists('pulse.sallary_benefits');

        // Pulse.Tax Group Histories Table
        Schema::dropIfExists('pulse.tax_group_histories');

        // Pulse.Taxes Table
        Schema::dropIfExists('pulse.taxes');

        // Pulse.Workshifts Table
        Schema::dropIfExists('pulse.workshifts');

        // Pulse.Employee Address Table
        Schema::dropIfExists('pulse.employee_address');
    }
};
