<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conclusions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('state_id')->nullable();
            $table->text('conclusion-1-1')->nullable();
            $table->text('conclusion-2-1')->nullable();
            $table->text('conclusion-3-1')->nullable();
            $table->text('conclusion-4-1')->nullable();
            $table->text('conclusion-5-1')->nullable();
            $table->text('conclusion-6-1')->nullable();
            $table->text('conclusion-7-1')->nullable();
            $table->text('conclusion-8-1')->nullable();
            $table->text('conclusion-9-1')->nullable();
            $table->text('conclusion-10-1')->nullable();
            $table->text('conclusion-11-1')->nullable();
            $table->text('conclusion-12-1')->nullable();
            $table->text('conclusion-13-1')->nullable();

            $table->text('conclusion-1-2')->nullable();
            $table->text('conclusion-2-2')->nullable();
            $table->text('conclusion-3-2')->nullable();
            $table->text('conclusion-4-2')->nullable();
            $table->text('conclusion-5-2')->nullable();
            $table->text('conclusion-6-2')->nullable();
            $table->text('conclusion-7-2')->nullable();
            $table->text('conclusion-8-2')->nullable();
            $table->text('conclusion-9-2')->nullable();
            $table->text('conclusion-10-2')->nullable();
            $table->text('conclusion-11-2')->nullable();
            $table->text('conclusion-12-2')->nullable();
            $table->text('conclusion-13-2')->nullable();

            $table->text('conclusion-1-3')->nullable();
            $table->text('conclusion-2-3')->nullable();
            $table->text('conclusion-3-3')->nullable();
            $table->text('conclusion-4-3')->nullable();
            $table->text('conclusion-5-3')->nullable();
            $table->text('conclusion-6-3')->nullable();
            $table->text('conclusion-7-3')->nullable();
            $table->text('conclusion-8-3')->nullable();
            $table->text('conclusion-9-3')->nullable();
            $table->text('conclusion-10-3')->nullable();
            $table->text('conclusion-11-3')->nullable();
            $table->text('conclusion-12-3')->nullable();
            $table->text('conclusion-13-3')->nullable();

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
        Schema::dropIfExists('conclusions');
    }
}
