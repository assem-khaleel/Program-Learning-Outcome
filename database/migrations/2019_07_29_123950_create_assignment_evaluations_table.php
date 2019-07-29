<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('assessment_id')->unsigned();
            $table->foreign('assessment_id')->references('id')->on('assignments')->onDelete('cascade');
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
        Schema::dropIfExists('assignment_evaluations');
    }
}
