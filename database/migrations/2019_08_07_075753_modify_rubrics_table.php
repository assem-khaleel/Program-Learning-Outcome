<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rubrics', function (Blueprint $table) {

            $table->bigInteger('plo_id')->unsigned()->nullable();
            $table->foreign('plo_id')
                ->references('id')->on('learning_outcomes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rubrics', function (Blueprint $table) {

            $table->bigInteger('plo_id')->change();
            $table->foreign('plo_id')
                ->references('id')->on('learning_outcomes')
                ->onDelete('cascade');
        });
    }
}
