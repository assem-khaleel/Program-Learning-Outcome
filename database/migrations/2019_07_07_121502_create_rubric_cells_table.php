<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_cells', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description');
            $table->bigInteger('indicator_id')->unsigned();
            $table->foreign('indicator_id')->references('id')->on('rubric_indicators')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('rubric_levels')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('rubric_cells');
    }
}
