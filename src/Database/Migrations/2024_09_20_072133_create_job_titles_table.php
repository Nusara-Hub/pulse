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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulse.job_titles');

        // For removing specific columns from a table
        // Schema::table('job_titles', function (Blueprint $table) {
        //     $table->dropColumn('exampleColumnName');
        // });
    }
};
