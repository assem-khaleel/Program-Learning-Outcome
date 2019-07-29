<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('assignments_id')->unsigned();
            $table->foreign('assignments_id')->references('id')->on('assignments')->onDelete('cascade');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->bigInteger('rubric_cell_id')->unsigned();
            $table->foreign('rubric_cell_id')->references('id')->on('rubric_cells')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_evaluations');
    }
}
