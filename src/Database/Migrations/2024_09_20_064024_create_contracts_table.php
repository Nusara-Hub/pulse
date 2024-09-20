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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulse.contracts');

        // For removing specific columns from a table
        // Schema::table('contracts', function (Blueprint $table) {
        //     $table->dropColumn('exampleColumnName');
        // });
    }
};
