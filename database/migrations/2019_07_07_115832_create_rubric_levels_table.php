<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level');
            $table->bigInteger('rubric_id')->unsigned();
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
            $table->integer('order')->unsigned();
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
        Schema::dropIfExists('rubric_levels');
    }
}
