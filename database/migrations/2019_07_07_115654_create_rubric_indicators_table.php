<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_indicators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('indicator');
            $table->integer('order')->unsigned();
            $table->integer('score')->unsigned();
            $table->bigInteger('rubric_id')->unsigned();
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
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
        Schema::dropIfExists('rubric_indicators');
    }
}
