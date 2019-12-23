<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('procedure');
            $table->boolean('initial_culprit');
            $table->integer('final_culprit');
            $table->bigInteger('type_accident_id')->unsigned();
            $table->foreign('type_accident_id')->references('id')->on('type_accidents');
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
        Schema::dropIfExists('accidents');
    }
}
