<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('teaching_id');
            $table->unsignedSmallInteger('student_id');
            $table->double('uh');
            $table->double('uts');
            $table->double('uas');
            $table->double('na');

            $table->foreign('teaching_id')->on('teachings')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('student_id')->on('students')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('points');
    }
}
