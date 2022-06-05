<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriterionConclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterion_conclusions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ambit_id')->nullable();
            $table->integer('decision_id')->nullable();
            $table->integer('criterion_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->text('conclusion')->nullable();
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
        Schema::dropIfExists('criterion_conclusions');
    }
}
