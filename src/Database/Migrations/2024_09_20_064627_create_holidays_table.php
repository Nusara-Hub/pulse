<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulse.holidays');

        // For removing specific columns from a table
        // Schema::table('holidays', function (Blueprint $table) {
        //     $table->dropColumn('exampleColumnName');
        // });
    }
};
