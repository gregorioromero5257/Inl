<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblematicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problematics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('state_id')->nullable();
            $table->text('problematic-1-1')->nullable();
            $table->text('problematic-2-1')->nullable();
            $table->text('problematic-3-1')->nullable();
            $table->text('problematic-4-1')->nullable();
            $table->text('problematic-5-1')->nullable();
            $table->text('problematic-6-1')->nullable();
            $table->text('problematic-7-1')->nullable();
            $table->text('problematic-8-1')->nullable();
            $table->text('problematic-9-1')->nullable();
            $table->text('problematic-10-1')->nullable();
            $table->text('problematic-11-1')->nullable();
            $table->text('problematic-12-1')->nullable();
            $table->text('problematic-13-1')->nullable();

            $table->text('problematic-1-2')->nullable();
            $table->text('problematic-2-2')->nullable();
            $table->text('problematic-3-2')->nullable();
            $table->text('problematic-4-2')->nullable();
            $table->text('problematic-5-2')->nullable();
            $table->text('problematic-6-2')->nullable();
            $table->text('problematic-7-2')->nullable();
            $table->text('problematic-8-2')->nullable();
            $table->text('problematic-9-2')->nullable();
            $table->text('problematic-10-2')->nullable();
            $table->text('problematic-11-2')->nullable();
            $table->text('problematic-12-2')->nullable();
            $table->text('problematic-13-2')->nullable();

            $table->text('problematic-1-3')->nullable();
            $table->text('problematic-2-3')->nullable();
            $table->text('problematic-3-3')->nullable();
            $table->text('problematic-4-3')->nullable();
            $table->text('problematic-5-3')->nullable();
            $table->text('problematic-6-3')->nullable();
            $table->text('problematic-7-3')->nullable();
            $table->text('problematic-8-3')->nullable();
            $table->text('problematic-9-3')->nullable();
            $table->text('problematic-10-3')->nullable();
            $table->text('problematic-11-3')->nullable();
            $table->text('problematic-12-3')->nullable();
            $table->text('problematic-13-3')->nullable();

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
        Schema::dropIfExists('problematics');
    }
}
