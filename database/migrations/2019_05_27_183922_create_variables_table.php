<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->nullable();
            $table->mediumText('name')->nullable();
            $table->string('source')->nullable();
            $table->string('slug_2018')->nullable();
            $table->string('check_slug_2018')->nullable();
            $table->string('slug_2017')->nullable();
            $table->string('check_slug_2017')->nullable();
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
        Schema::dropIfExists('variables');
    }
}
