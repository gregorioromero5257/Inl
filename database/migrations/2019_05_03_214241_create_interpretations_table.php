<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterpretationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interpretations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->nullable();
            $table->text('interpretation1')->nullable();
            $table->text('interpretation2')->nullable();
            $table->text('interpretation3')->nullable();
            $table->text('interpretation4')->nullable();
            $table->text('interpretation5')->nullable();
            $table->text('interpretation6')->nullable();
            $table->text('interpretation7')->nullable();
            $table->text('interpretation8')->nullable();
            $table->text('interpretation9')->nullable();
            $table->text('interpretation10')->nullable();
            $table->text('interpretation11')->nullable();
            $table->text('interpretation12')->nullable();
            $table->text('interpretation13')->nullable();
            $table->text('interpretation14')->nullable();
            $table->text('interpretation15')->nullable();
            $table->text('interpretation16')->nullable();
            $table->text('interpretation17')->nullable();
            $table->text('interpretation18')->nullable();
            $table->text('interpretation19')->nullable();
            $table->text('interpretation20')->nullable();
            $table->text('interpretation21')->nullable();
            $table->text('interpretation22')->nullable();
            $table->text('interpretation23')->nullable();
            $table->text('interpretation24')->nullable();
            $table->text('interpretation25')->nullable();
            $table->text('interpretation26')->nullable();
            $table->text('interpretation27')->nullable();
            $table->text('interpretation28')->nullable();
            $table->text('interpretation29')->nullable();
            $table->text('interpretation30')->nullable();
            $table->text('interpretation31')->nullable();
            $table->text('interpretation32')->nullable();
            $table->text('interpretation33')->nullable();
            $table->text('interpretation34')->nullable();
            $table->text('interpretation35')->nullable();
            $table->text('interpretation36')->nullable();
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
        Schema::dropIfExists('interpretations');
    }
}
