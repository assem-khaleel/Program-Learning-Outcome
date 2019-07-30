<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->bigInteger('course_sections_id')->unsigned();
            $table->foreign('course_sections_id')->references('id')->on('course_sections')->onDelete('cascade');
            $table->bigInteger('rubric_id')->unsigned();
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
            $table->boolean('published')->default(0);
            $table->softDeletes();
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

        Schema::dropIfExists('assignments');
    }
}
